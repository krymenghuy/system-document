@extends('backends.layouts.master')
@section('title')
    {{ __('Documents') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="fa fa-file"></i> {{ __('Documents') }}</h2>
        </div>
        <div class="card-header">
            @if (checkPermission('document', 'create'))
                <a href="{{ route('admin.documents.create') }}" class="btn btn-primary btn-sm"><i
                        class="fa fa-plus-circle"></i> {{ __('Create') }}</a>
            @endif
            <div class="row">
                <div class="col"></div>
                <div class="col-3">
                    <form action="{{ route('admin.documents') }}" method="GET">
                        <div class="input-group">
                            <input type="search" value="{{ $search }}" class="form-control" name="search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-search"></i> {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive my-2">
                <table class="table table-sm table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Publication Year') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $index => $document)
                            <tr>
                                <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="vertical-align: middle;">{{ $document->name }}</td>
                                <td style="vertical-align: middle;">{{ $document->author }}</td>
                                <td style="vertical-align: middle;">{{ $document->publication_year }}</td>
                                <td style="vertical-align: middle;">{{ $document->category->name }}</td>
                                <td style="vertical-align: middle;">
                                    @if (checkPermission('document', 'view'))
                                        <a href="{{ route('admin.documents.show', $document->id) }}"
                                            class="btn btn-sm btn-success"><i class="fa fa-pen"></i>
                                            {{ __('Show') }}</a>
                                    @endif
                                    @if (checkPermission('document', 'edit'))
                                        <a href="{{ route('admin.documents.edit', $document->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fa fa-pen"></i>
                                            {{ __('Edit') }}</a>
                                    @endif
                                    @if (checkPermission('document', 'delete'))
                                        <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('{{ __('Are you sure?') }}')"><i
                                                    class="fa fa-trash"></i> {{ __('Delete') }}</button>
                                        </form>
                                    @endif
                                    @if (checkPermission('document', 'download'))
                                        <a href="{{ $document->file_path }}" target="_blank" class="btn btn-sm btn-info"><i
                                                class="fa fa-download"></i> {{ __('Download') }}</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $documents->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    @endsection

    @push('css')
        <style>
            .pagination {
                justify-content: end;
            }
        </style>
    @endpush
