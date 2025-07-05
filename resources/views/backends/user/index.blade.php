@extends('backends.layouts.master')
@section('title')
    {{__('User')}}
@endsection
@section('content')
   <div class="card">
    <div class="card-header text-primary">
        <h2><i class="fa fa-users"></i> {{__('User')}}</h2>
    </div>
    <div class="card-header">
        @if(checkPermission('user','create'))
        <a href="{{route('admin.user.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> {{__('Create')}}</a>
        @endif
        <div class="table-responsive my-2">
            <table class="table table-sm table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Photo')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Role')}}</th>
                        <th>{{__('Username')}}</th>
                        <th>{{__('Email')}}</th>
                        {{-- <th>{{__('Status')}}</th> --}}
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td  style="vertical-align: middle;">{{ $index + 1 }}</td>
                            <td  style="vertical-align: middle;">
                                <img src="{{ asset($user->photo) }}" width="50" height="50" class="rounded-circle" alt="">
                            </td>
                            <td  style="vertical-align: middle;">{{ $user->name }}</td>
                            <td  style="vertical-align: middle;">{{ $user->role_name }}</td>
                            <td  style="vertical-align: middle;">{{ $user->username }}</td>
                            <td  style="vertical-align: middle;">{{ $user->email }}</td>
                            {{-- <td  style="vertical-align: middle;">
                                @if($user->status == 1)
                                    <span class="badge bg-primary">{{__('Active')}}</span>
                                @else
                                    <span class="badge bg-danger">{{__('Inactive')}}</span>
                                @endif
                            </td> --}}
                            <td  style="vertical-align: middle;">
                             @if(checkPermission('user','edit'))
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-success"><i class="fa fa-pen"></i> {{__('Edit')}}</a>
                            @endif

                                @if(checkPermission('user','delete'))
                                    @php
                                        $btnDelete = '<a href="' . route('admin.user.delete', $user->id) . '" class="btn btn-sm btn-danger"> ' . __('Yes') . '</a>';
                                        $btnDelete .= '<span class="btn btn-sm btn-dark ml-1 popNo">'. __('No') .'</span>';
                                    @endphp

                                    <button type="button" class="btn btn-sm btn-danger pop" data-toggle="popover" data-trigger="focus" title="{{__('Are you sure ?')}}" data-html="true" data-content="<div class='text-center'>{{ $btnDelete }}</div>"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-12">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
   </div>

@endsection

@push('js')
<script>
    $(function () {
        $('.pop').popover({
            container: 'body',
            animation: true
        })

    })
</script>
@endpush

@push('css')
<style>
    .pagination {
   justify-content: end;
}
</style>
@endpush