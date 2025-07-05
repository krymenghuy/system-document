@extends('backends.layouts.master')
@section('title')
   {{__('Permission')}}
@endsection
@section('content')
   <div class="card">
    <div class="card-header text-primary">
        <h2><i class="fa fa-user-check"></i> {{__('Permission')}}</h2>
    </div>
    <div class="card-header">
        <a href="{{ route('admin.permission.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{__('Create')}}</a>
    </div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Key')}}</th>
                    <th>{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $index => $per)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $per->name }}</td>
                        <td>{{ $per->alias }}</td>
                        <td>
                            <a href="{{ route('admin.permission.edit', base64_encode($per->id)) }}" class="btn btn-sm btn-success"><i class="fa fa-pen"></i> {{__('Edit')}}</a>

                            @php
                                $btnDelete = '<a href="' . route('admin.permission.delete', $per->id) . '" class="btn btn-sm btn-danger"> ' . __('Yes') . '</a>';
                                $btnDelete .= '<span class="btn btn-sm btn-dark ml-1 popNo">'. __('No') .'</span>';
                            @endphp

                            <button type="button" class="btn btn-sm btn-danger pop" data-toggle="popover" data-trigger="focus" title="{{__('Are you sure ?')}}" data-html="true" data-content="<div class='text-center'>{{ $btnDelete }}</div>"><i class="fa fa-trash"></i> {{__('Delete')}}</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{__('No Data')}}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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