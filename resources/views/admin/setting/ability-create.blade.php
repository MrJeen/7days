@extends('admin.setting.index')

@section('title')
    @parent - 添加权限
@endsection

<?php $setting_sidebar = 'ability' ?>

@push('css')
    <link rel="stylesheet" href="{{ asset('zTree/css/zTreeStyle.css') }}">
@endpush

@section('setting-content')

    <nav class="navbar navbar-expand-lg">
        <a class="mr-2" href="{{ route('admin_ability') }}">权限管理</a>/<span class="ml-2">添加权限</span>
    </nav>
    <hr class="my-2">

    @include('admin.layouts.flash')

    <form action="{{ route('admin_ability_store') }}" class="py-4" method="post">
        @csrf
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">权限名</label>
            <div class="col-sm-10">
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="权限名" required>
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">权限编码（别名）</label>
            <div class="col-sm-10">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="权限编码" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="parentId" class="col-sm-2 col-form-label">从属</label>
            <div class="col-sm-10">
                <input type="hidden" name="parentId" id="parentId" value="0">
                <ul id="ztree" class="ztree"></ul>
            </div>
        </div>
        <div class="form-group text-right">
            <button id="submit" class="btn btn-success">提交</button>
        </div>
    </form>


@endsection

@push('scripts')
    <script src="{{ asset('zTree/js/jquery.ztree.all.min.js') }}"></script>
    <script>
        var zTreeObj,
        setting = {
                check: {
                    enable: true,
                    chkStyle: "radio",
                    radioType: "all"
                },
                view: {
                    selectedMulti: false
                },
                callback: {
                    onCheck: zTreeOnCheck
                }
            },
        zTreeNodes = {!! $zTreeData !!}

        $(document).ready(function () {
            zTreeObj = $.fn.zTree.init($("#ztree"), setting, zTreeNodes);
        });

        function zTreeOnCheck(event, treeId, treeNode) {
            if(treeNode.checked){
                $("#parentId").val(treeNode.id);
            }else{
                $("#parentId").val(0);
            }
        };

    </script>
@endpush




