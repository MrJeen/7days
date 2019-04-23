@extends('admin.layouts.app')

@section('title')
    系统
@endsection

<?php $sidebar = 'setting' ?>

@section('content')
    <div class="container-main row">

        <!-- sidebar -->
        <div class="col-sm-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action @if($setting_sidebar == 'role') active @endif" href="{{ route('admin_role') }}">角色管理</a>
                <a class="list-group-item list-group-item-action @if($setting_sidebar == 'ability') active @endif" href="{{ route('admin_ability') }}">权限管理</a>
                <a class="list-group-item list-group-item-action" href="#">用户设置</a>
                <a class="list-group-item list-group-item-action" href="#">课程设置</a>
                <a class="list-group-item list-group-item-action @if($setting_sidebar == 'dictionary') active @endif" href="{{ route('admin_dictionary') }}">数据字典</a>
            </div>
        </div>

        <!-- content -->
        <div class="col-sm-10">
            @yield('setting-content')
        </div>
    </div>
@endsection
