@extends('admin.setting.index')

@section('title')
    @parent - 角色管理
@endsection

<?php $setting_sidebar = 'role' ?>

@push('css')
    <link rel="stylesheet" href="{{ asset('dataTables/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('zTree/css/zTreeStyle.css') }}">
@endpush

@section('setting-content')
    <nav class="navbar navbar-expand-lg">
        <div>角色管理</div>
        <div class="ml-auto">
            <a href="{{ route('admin_role_create') }}" class="btn btn-outline-success">添加角色</a>
        </div>
    </nav>

    <hr class="my-2">

    @include('admin.layouts.flash')

    <div class="table-responsive">
        @if(count($data))
            <table class="table table-bordered table-hover dataTable role-table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>角色名</th>
                    <th>角色编码</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td><a href="javascript:;" data-url="{{ route('admin_role_ability',['id'=>$item->id]) }}" class="btn btn-outline-info allot">分配权限</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">无数据记录</div>
        @endif
        {{ $data->links() }}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true"></div>

@endsection

@push('scripts')
    <script src="{{ asset('dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('zTree/js/jquery.ztree.all.min.js') }}"></script>
    <script>
        $('.role-table').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false,
            'order': []
        })

        $(".allot").click(function(){
            $.ajax({
                url: $(this).data('url'),
                success: function(html){
                    $("#modal").html(html).modal('show');
                },
                error: function(){

                }
            });
        });
    </script>
@endpush
