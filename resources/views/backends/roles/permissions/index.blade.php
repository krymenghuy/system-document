@extends('backends.layouts.master')
@section('title')
    {{ __('Role Permission') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="fa fa-user-check"></i> {{ __('Role Permission') }}</h2>
        </div>
        <div class="card-header">
            <a href="{{ route('admin.role') }}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i>
                {{ __('Back') }}</a>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>{{ __('Permission') }}</th>
                        <th>{{ __('View') }}</th>
                        <th>{{ __('Create') }}</th>
                        <th>{{ __('Edit') }}</th>
                        <th>{{ __('Delete') }}</th>
                        <th>{{ __('download') }}</th>
                        <th>{{ __('Show') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($role_permissions as $role_permission)
                        <tr>
                            <td>{{ $role_permission->name }}</td>
                            <td>
                                <input
                                    onclick="handlePermission('views',{{ $role_permission->role_permission_id }},{{ $role_permission->views }},{{ $role_permission->id }})"
                                    type="checkbox" value="{{ $role_permission->views }}"
                                    {{ $role_permission->views == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input
                                    onclick="handlePermission('store',{{ $role_permission->role_permission_id }},{{ $role_permission->store }},{{ $role_permission->id }})"
                                    type="checkbox" value="{{ $role_permission->store }}"
                                    {{ $role_permission->store == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input
                                    onclick="handlePermission('edit',{{ $role_permission->role_permission_id }},{{ $role_permission->edit }},{{ $role_permission->id }})"
                                    type="checkbox" value="{{ $role_permission->edit }}"
                                    {{ $role_permission->edit == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input
                                    onclick="handlePermission('remove',{{ $role_permission->role_permission_id }},{{ $role_permission->remove }},{{ $role_permission->id }})"
                                    type="checkbox" value="{{ $role_permission->remove }}"
                                    {{ $role_permission->remove == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input
                                    onclick="handlePermission('show',{{ $role_permission->role_permission_id }},{{ $role_permission->detail }},{{ $role_permission->id }})"
                                    type="checkbox" value="{{ $role_permission->detail }}"
                                    {{ $role_permission->detail == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input
                                    onclick="handlePermission('download',{{ $role_permission->role_permission_id }},{{ $role_permission->download }},{{ $role_permission->id }})"
                                    type="checkbox" value="{{ $role_permission->download }}"
                                    {{ $role_permission->download == 1 ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function handlePermission(permission, role_permission_id, role_permission_value, permission_id) {
            let url = "{{ route('admin.role.permission.update', $role_id) }}";
            role_permission_value = role_permission_value == 0 ? 1 : 0;

            url += "?permission=" + permission + "&permission_id=" + permission_id + "&role_permission_id=" +
                role_permission_id + "&role_permission_value=" + role_permission_value;

            window.location.href = url;
        }
    </script>
@endpush
