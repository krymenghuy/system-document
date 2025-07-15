@extends('backends.layouts.master')
@section('title')
    roles page
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="fa fa-user-check"></i>Role</h2>
        </div>
        <div class="card-header">
            <div class="card-header">
                @if (checkPermission('role', 'create'))
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i>
                        {{ __('Create') }}</a>
                @endif
                <div class="table-responsive my-2">
                    <table class="table table-sm table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $index => $role)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if (checkPermission('role', 'edit'))
                                            <a href="{{ route('admin.role.permission', $role->id) }}"
                                                class="btn btn-sm btn-warning"><i class="fa fa-key"></i>Permission</a>
                                            <a href="{{ route('admin.role.edit', $role->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-pen"></i>Edit</a>
                                        @endif

                                        @if(checkPermission('role','delete'))
                                            @php
                                                $btnDelete =
                                                    '<a href="' .
                                                    route('admin.role.delete', $role->id) .
                                                    '" class="btn btn-sm btn-danger"> ' .
                                                    __('Yes') .
                                                    '</a>';
                                                $btnDelete .=
                                                    '<span class="btn btn-sm btn-dark ml-1 popNo">' .
                                                    __('No') .
                                                    '</span>';
                                            @endphp
                                            

                                            <button type="button" class="btn btn-sm btn-danger pop" data-toggle="popover"
                                                data-trigger="focus" title="{{ __('Are you sure ?') }}" data-html="true"
                                                data-content="<div class='text-center'>{{ $btnDelete }}</div>"><i
                                                    class="fa fa-trash"></i> {{ __('Delete') }}</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ $roles->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script>
            $(function() {
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
