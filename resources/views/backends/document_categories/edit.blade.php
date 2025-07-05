@extends('backends.layouts.master')
@section('title')
    {{ __('Edit document Category') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="fa fa-user"></i> {{ __('Edit document Category') }}</h2>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.document_category') }}" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i>
                {{ __('Back') }}</a>
            <form action="{{ route('admin.document_category.update', $document_category->id) }}" class="my-2" method="POST">
                @csrf


                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="mb-3">
                            <label for="name">{{ __('Category Name') }} <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" value="{{ $document_category->name }}"
                                name="name" required>
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
