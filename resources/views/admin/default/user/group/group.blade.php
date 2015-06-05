@extends('default.main')
@section('content')
<script src="/default/app/js/groups.js"></script>
<div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><a href="#" onclick="Group.form()"><i class="glyphicon glyphicon-plus-sign"></i>添加</a></h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>组名称</th>
                    <th>权限</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                <tr id='row_{{$group->id}}'>
                    <td>{{$group->id}}</td>
                    <td>{{$group->name}}</td>
                    <td>{{$group->permissions}}</td>
                    <td class="center">
                        <a class="btn btn-info" href="#" onclick="Group.form({{$group->id}})">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            编辑
                        </a>
                        <a class="btn btn-danger" href="#" onclick="Group.del({{$group->id}})">
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