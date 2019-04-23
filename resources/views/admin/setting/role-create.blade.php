@extends('admin.setting.index')

@section('title')
    @parent - 添加角色
@endsection

<?php $setting_sidebar = 'role' ?>

@section('setting-content')

    <nav class="navbar navbar-expand-lg">
        <a class="mr-2" href="{{ route('admin_role') }}">角色管理</a>/<span class="ml-2">添加角色</span>
    </nav>
    <hr class="my-2">

    @include('admin.layouts.flash')

    <form action="{{ route('admin_role_store') }}" class="py-4" method="post">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">角色名</label>
            <div class="col-sm-10">
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="角色编码" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">角色编码</label>
            <div class="col-sm-10">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="角色名" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group text-right">
            <button class="btn btn-success">提交</button>
        </div>
    </form>
@endsection




