@extends('default.main')
@section('content')
<script src="/default/app/js/user.js"></script>
<div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><a href="#" onclick="User.form()"><i class="glyphicon glyphicon-plus-sign"></i>添加</a></h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>邮箱</th>
                    <th>用户名</th>
                    <th>角色</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr id='row_{{$user->id}}'>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->group}}</td>
                    <td><span class="label-warning label label-default">激活</span></td>
                    <td class="center">
                        <a class="btn btn-warning" href="#" onclick="User.update_passwd({{$user->id}})">
                            <i class="glyphicon glyphicon-qrcode icon-white"></i>
                            重置密码
                        </a>

                        <a class="btn btn-info" href="#" onclick="User.form({{$user->id}})">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            编辑
                        </a>
                        <a class="btn btn-danger" href="#" onclick="User.del({{$user->id}})">
                            <i class="glyphicon glyphicon-trash icon-white"></i>
                            删除
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop