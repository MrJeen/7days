@extends('admin.layouts.app')

@section('title')
   @parent - 用户
@endsection

<?php $sidebar = 'user' ?>

@section('content')
    <div class="container-main row">

        <!-- sidebar -->
        <div class="col-sm-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action @if($user_sidebar == 'user') active @endif" href="{{ route('admin_user') }}">用户管理</a>
                <a class="list-group-item list-group-item-action" href="#">档案管理</a>
                <a class="list-group-item list-group-item-action" href="#">出勤管理</a>
                <a class="list-group-item list-group-item-action" href="#">课程分配</a>
                <a class="list-group-item list-group-item-action" href="#">学习进度</a>
            </div>
        </div>

        <!-- content -->
        <div class="col-sm-10">
            @yield('user-content')
        </div>
    </div>
@endsection



