@extends('admin.setting.index')

@section('title')
    @parent - 数据字典
@endsection

<?php $setting_sidebar = 'dictionary' ?>

@section('load_css')
    <link rel="stylesheet" href="{{ asset('dataTables/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('setting-content')
    <nav class="navbar navbar-expand-lg">
        <div>数据字典</div>
        <div class="ml-auto">
            <a href="{{ route('admin_dictionary_create') }}" class="btn btn-outline-success">添加属性</a>
        </div>
    </nav>

    <hr class="my-2">

    @include('admin.layouts.flash')

    <div class="table-responsive">
        @if(count($data))
            <table class="table table-bordered table-hover dataTable dictionary-table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>属性名</th>
                    <th>属性编码（别名）</th>
                    <th>从属</th>
                    <th>更新时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->alias }}</td>
                        <td>@if($item->parent) {{ $item->parent->name }} @endif</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">无数据记录</div>
        @endif
        {{ $data->links() }}
    </div>

@endsection

@section('load_js')
    <script src="{{ asset('dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $('.dictionary-table').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false,
            'order': []
        })
    </script>
@endsection
