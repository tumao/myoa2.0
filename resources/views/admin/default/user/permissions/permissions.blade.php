@extends('default.main')
@section('content')
<script src="/default/app/js/permissions.js"></script>
<div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><a href="#" onclick="Permissions.form()"><i class="glyphicon glyphicon-plus-sign"></i>添加</a></h2>
    </div>
    <div class="box-content">
        <table id="permission-table" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>权限编码</th>
                    <th>权限名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr id='row_{{$permission->id}}'>
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->display_name}}</td>
                    <td class="center">
                        <a class="btn btn-info" href="#" onclick='Permissions.form({{json_encode($permission)}})'>
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            编辑
                        </a>
                        <a class="btn btn-danger" href="#" onclick='Permissions.del({{$permission->id}},"{{$permission->name}}")'>
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