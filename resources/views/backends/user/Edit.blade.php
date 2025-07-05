@extends('backends.layouts.master')
@section('title')
    {{ __('Edit User') }}
@endsection
@section('content')
   <div class="card">
    <div class="card-header text-primary">
        <h2><i class="fa fa-user"></i> {{__("Edit User")}}</h2>
    </div>
    <div class="card-body">
        <a href="{{route('admin.user')}}" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> {{__('Back')}}</a>
        <form action="{{ route('admin.user.update', $user->id) }}" class="my-2" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="name">{{__('Name')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">{{__('Email')}}</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                    </div>
                    <div class="mb-3">
                        {{-- <label for="status">{{__('Status')}}</label> --}}
                        {{-- <select name="status" class="form-control" id="" required>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>{{__('Inactive')}}</option>
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>{{__('Active')}}</option>
                        </select> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="role">{{__('Role')}} <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">{{__('Please Select')}}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->value }}" {{ $role->value == $user->role ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="username">{{__('Username')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $user->username }}" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">{{__('Password')}}</label>
                        <input type="text" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="photo">{{__('Photo')}}</label>
                        <input type="file" accept="image/*" class="form-control" name="photo" id="photo">
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Submit')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
   </div>

@endsection