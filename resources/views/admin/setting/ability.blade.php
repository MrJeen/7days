@extends('admin.setting.index')

@section('title')
    @parent - 权限管理
@endsection

<?php $setting_sidebar = 'ability' ?>

@push('css')
    <link rel="stylesheet" href="{{ asset('dataTables/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('setting-content')
    <nav class="navbar navbar-expand-lg">
        <div>权限管理</div>
        <div class="ml-auto">
            <a href="{{ route('admin_ability_create') }}" class="btn btn-outline-success">添加权限</a>
        </div>
    </nav>

    <hr class="my-2">

    @include('admin.layouts.flash')

    <div class="table-responsive">
        @if(count($data))
            <table class="table table-bordered table-hover dataTable ability-table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>权限名</th>
                    <th>权限编码（别名）</th>
                    <th>从属</th>
                    <th>是否可见</th>
                    <th>排序</th>
                    <th>更新时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->name }}</td>
                        <td>@if($item->parent) {{ $item->parent->title }} @endif</td>
                        <td>@if($item->visible) 是 @else 否 @endif</td>
                        <td>{{ $item->seq }}</td>
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

@push('scripts')
    <script src="{{ asset('dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $('.ability-table').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false,
            'order': []
        })
    </script>
@endpush
