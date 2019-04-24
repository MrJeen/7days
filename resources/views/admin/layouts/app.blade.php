<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('css')

    <title>后台管理 - @yield('title')</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <a class="navbar-brand @if($sidebar == 'home') active @endif" href="{{ route('admin_home') }}">7天网络课堂管理后台</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if($sidebar == 'user') active @endif">
                    <a class="nav-link" href="{{ route('admin_user') }}">用户</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">课程</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">运营</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">订单</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($sidebar == 'setting') active @endif" href="{{ route('admin_role') }}">系统</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">嘉文邮箱</a>
                </li>
            </ul>

            <ul class="navbar-nav my-2 my-lg-0 dropdown">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            退出
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    {{--@inject('nav', 'App\Http\Controllers\Admin\InjectController')--}}
    {{--{!! $nav->navigation() !!}--}}

    @yield('content')
</div>

<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')

</body>
</html>