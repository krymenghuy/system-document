@extends('backends.layouts.master')
@section('title')
    {{ __('document Category') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="fa fa-users"></i> {{ __('document Category') }}</h2>
        </div>
        <div class="card-header">
            @if (checkPermission('document_category', 'create'))
                <a href="{{ route('admin.document_category.create') }}" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus-circle"></i> {{ __('Create') }}</a>
            @endif
            <div class="table-responsive my-2">
                <table class="table table-sm table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Category Name') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($document_categories as $index => $item)
                            <tr>
                                <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="vertical-align: middle;">{{ $item->name }}</td>
                                <td style="vertical-align: middle;">
                                    @if (checkPermission('document_category', 'edit'))
                                        <a href="{{ route('admin.document_category.edit', $item->id) }}"
                                            class="btn btn-sm btn-success"><i class="fa fa-pen"></i> {{ __('Edit') }}</a>
                                    @endif

                                    @if (checkPermission('document_category', 'delete'))
                                        @php
                                            $btnDelete =
                                                '<a href="' .
                                                route('admin.document_category.delete', $item->id) .
                                                '" class="btn btn-sm btn-danger"> ' .
                                                __('Yes') .
                                                '</a>';
                                            $btnDelete .=
                                                '<span class="btn btn-sm btn-dark ml-1 popNo">' . __('No') . '</span>';
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
                    {{ $document_categories->links('pagination::bootstrap-4') }}
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
