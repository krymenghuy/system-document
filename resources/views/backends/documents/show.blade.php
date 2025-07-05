@extends('backends.layouts.master')
@section('title')
    {{ __('Create document Category') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="fa fa-user-check"></i> {{ __('Create Documents') }}</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.documents') }}" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i>
                {{ __('Back') }}</a>

            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="name">{{ __('Document Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" required
                            value="{{ $document->name }}" placeholder="{{ __('Document Name') }}">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="author">{{ __('Author') }}</label>
                        <input type="text" name="author" id="author" class="form-control" required
                            value="{{ $document->author }}" placeholder="{{ __('Author') }}">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="publication_year">{{ __('Publication Year') }}</label>
                        <input type="text" name="publication_year" id="publication_year" class="form-control" required
                            value="{{ $document->publication_year }}" placeholder="{{ __('Publication Year') }}">
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="category_id">{{ __('Category') }}</label>
                        <input type="text" name="category_id" id="category_id" class="form-control" required
                            value="{{ $document->category->name }}" placeholder="{{ __('Category') }}">
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="file">{{ __('File') }}</label>
                        <iframe src="{{ $document->file_path }}" width="100%" height="500px"></iframe>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description" class="form-control" required placeholder="{{ __('Description') }}">{{ $document->description }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-primary">
                {{ __('Comments') }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.documents.evaluations', $document->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div class="w-100 mr-2">
                                <input type="text" name="text" id="evaluation" class="form-control" required
                                    value="{{ $document->evaluation }}" placeholder="{{ __('Evaluation') }}">
                            </div>
                            <div>
                                <button class="btn btn-md btn-primary text-nowrap" type="submit"><i class="fa fa-save"></i>
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- loop for evaluations comments --}}

                @foreach ($document->evaluations as $evaluation)
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="w-100">
                                    <p class="mb-0">{{ $evaluation->text }}</p>
                                </div>
                                <div @if ($evaluation->user_id != auth()->id()) class="d-none" @endif>
                                    <button class="btn btn-sm btn-danger text-nowrap delete-evaluation" 
                                            data-id="{{ $evaluation->id }}">
                                        <i class="fa fa-trash"></i> {{ __('Delete') }}
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
