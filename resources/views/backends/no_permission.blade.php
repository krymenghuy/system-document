@extends('backends.layouts.master')
@section('title')
    No Permission
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-danger">{{__('No Permission')}}</div>
            <div class="card-body">
                <h2 class="text-warning">{{__('You are no permission to access this path')}}</h2>
                <p>{{__('Please Contact to your admin !!!')}}</p>
            </div>
        </div>
    </div>
@endsection