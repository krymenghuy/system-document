@extends('backends.layouts.master')
@section('title')
    Edit Role
@endsection
@section('content')
   <div class="card">
    <div class="card-header text-primary">
        <h2><i class="fa fa-user-check"></i>Edit Role</h2>
    </div>
    <div class="card-body">
        <a href="{{route('admin.role')}}" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> {{__('Back')}}</a>
        <form action="{{ route('admin.role.update', $role->id) }}" class="my-2" method="POST">
            @csrf

            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $role->name }}" required>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
   </div>

@endsection