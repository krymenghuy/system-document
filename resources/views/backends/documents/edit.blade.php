@extends('backends.layouts.master')
@section('title')
    {{ __('Edit Permission') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="fa fa-user-check"></i> {{ __('Edit Document') }}</h2>
        </div>
        <div class="card-header">
            <a href="{{ route('admin.documents') }}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>
                {{ __('Back') }}</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.documents.update', $document->id) }}" class="my-2" method="POST">
                @csrf
                {{-- <form action="{{ route('admin.documents.store') }}" class="my-2" method="POST" enctype="multipart/form-data">
                @csrf --}}
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="mb-3">
                            <label for="name">{{ __('Document Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required  value="{{ $document->name }}"
                                placeholder="{{ __('Document Name') }}">   
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="mb-3">
                            <label for="author">{{ __('Author') }}</label>
                            <input type="text" name="author" id="author" class="form-control" required value="{{ $document->author}}"
                                placeholder="{{ __('Author') }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="mb-3">
                            <label for="publication_year">{{ __('Publication Year') }}</label>
                            <input type="text" name="publication_year" id="publication_year" class="form-control" required value="{{ $document->publication_year}}"
                                placeholder="{{ __('Publication Year') }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="mb-3">
                            <label for="category_id">{{ __('Category') }}</label>
                            <select name="category_id" id="category_id" class="form-control" required  value="{{ $document->category_id}}"
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" id="description" class="form-control" required
                                placeholder="{{ __('Description') }}">{{ $document->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="file">{{ __('File') }}</label>
                            <input type="file" name="file" id="file" class="form-control" 
                                placeholder="{{ __('File') }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-right">
                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i>
                                {{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
