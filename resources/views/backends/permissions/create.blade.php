@extends('backends.layouts.master')
@section('title')
   {{__('Create Permission')}}
@endsection
@section('content')
   <div class="card">
    <div class="card-header text-primary">
        <h2><i class="fa fa-user-check"></i> {{__('Create Permission')}}</h2>
    </div>
    <div class="card-header">
        <a href="{{route('admin.permission')}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> {{__('Back')}}</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.permission.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <label for="name">{{__('Name')}}</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="key">{{__('Key')}}</label>
                    <input type="text" class="form-control" name="key" required>
                </div>
                <div class="col-12 my-2 text-right">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> {{__('Submit')}}</button>
                </div>
            </div>
        </form>
    </div>
   </div>

@endsection