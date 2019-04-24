@extends('admin.user.index')

@section('title')
    @parent - 用户管理
@endsection

<?php $user_sidebar = 'user' ?>

@push('css')
    <link rel="stylesheet" href="{{ asset('dataTables/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('user-content')

    <nav class="navbar navbar-expand-lg">
        <div>用户管理</div>
        <div class="ml-auto">
            <a href="{{ route('admin_user_create') }}" class="btn btn-outline-success">添加新用户</a>
        </div>
    </nav>

    <hr class="my-2">

    @include('admin.layouts.flash')

    <div class="table-responsive">
        @if(count($users))
            <table class="table table-bordered table-hover dataTable user-table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>姓名</th>
                    <th>邮箱</th>
                    <th>注册日期</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td><a href="javascript:;" data-url="{{ route('admin_user_role',['id'=>$user->id]) }}" class="btn btn-outline-info allot">分配角色</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">无数据记录</div>
        @endif
        {{ $users->links() }}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true"></div>
@endsection

@push('scripts')
    <script src="{{ asset('dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $('.user-table').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false,
            'order': []
        })

        $(".allot").click(function() {
            $.ajax({
                url: $(this).data('url'),
                success: function (html) {
                    $("#modal").html(html).modal('show');
                },
                error: function () {

                }
            });
        });

    </script>
@endpush