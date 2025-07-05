@extends('backends.layouts.master')
@section('title')
    {{ __('Edit Company') }}
@endsection
@section('content')
    <div class="container">
        <a href="{{ route('admin.company') }}" class="btn btn-danger"><i class="fa fa-reply"></i> {{__('Back')}}</a>
        <form action="{{ route('admin.company.update') }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <div class="row my-4">
                <div class="col-lg-3 col-12">
                    <div class="w-100 text-center">
                        <img src="{{ asset($company->photo ? $company->photo : '/images/photo/cat.jpg') }}" class="rounded-circle border border-primary" width="100" height="100" alt="">
                        <div class="w-100 my-3">
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>
                  
                </div>
                <div class="col-lg-9 col-12">
                    <table class="table table-sm table-hover">
                        <tbody>
                            <tr>
                                <td>{{__('Name')}}</td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $company->name }}" name="name" required>
                                </td>
                            </tr>
                            <tr>
                                <td>{{__('Email')}}</td>
                                <td>
                                    <input type="email" class="form-control" value="{{ $company->email }}" name="email">
                                </td>
                            </tr>
                            <tr>
                                <td>{{__('Phone')}}</td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $company->phone }}" name="phone">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> {{__('Submit')}}
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection