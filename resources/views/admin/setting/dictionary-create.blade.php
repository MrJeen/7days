@extends('admin.setting.index')

@section('title')
    @parent - 添加属性
@endsection

<?php $setting_sidebar = 'dictionary' ?>

@push('css')
    <link rel="stylesheet" href="{{ asset('zTree/css/zTreeStyle.css') }}">
@endpush

@section('setting-content')

    <nav class="navbar navbar-expand-lg">
        <a class="mr-2" href="{{ route('admin_dictionary') }}">数据字典</a>/<span class="ml-2">添加属性</span>
    </nav>
    <hr class="my-2">

    @include('admin.layouts.flash')

    <form action="{{ route('admin_dictionary_store') }}" class="py-4" method="post">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">属性名</label>
            <div class="col-sm-10">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="属性名" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="alias" class="col-sm-2 col-form-label">属性编码（别名）</label>
            <div class="col-sm-10">
                <input id="alias" type="text" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" name="alias" value="{{ old('alias') }}" placeholder="属性编码" required>
                @if ($errors->has('alias'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('alias') }}</strong>
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
            console.log(treeNode)
            if(treeNode.checked){
                $("#parentId").val(treeNode.id);
            }else{
                $("#parentId").val(0);
            }
        };

    </script>
@endpush




