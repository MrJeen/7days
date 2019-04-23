@extends('admin.user.index')

@section('title')
    @parent - 添加用户
@endsection

<?php $user_sidebar = 'user' ?>

@section('user-content')

    <nav class="navbar navbar-expand-lg">
        添加新用户
    </nav>
    <hr class="my-2">

    <form action="{{ route('admin_user_store') }}" class="py-4" method="post">
        @csrf
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">用户名</label>
            <div class="col-sm-10">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="用户名" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">邮箱</label>
            <div class="col-sm-10">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="邮箱" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">密码</label>
            <div class="col-sm-10">
                <input name="password" type="text" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="密码" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group text-right">
            <button class="btn btn-success">提交</button>
        </div>
    </form>
@endsection




