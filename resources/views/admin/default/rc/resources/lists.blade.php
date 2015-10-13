@extends('default.main')
@section('content')

<style type="text/css" link='/default/app/css/rc.css'></style>
<div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2>
            <a href="#" onclick="Picture.form()">
                <i class="glyphicon glyphicon-plus-sign"></i>
                添加
            </a>
        </h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>图片</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pics as $pic)
                <tr>
                    <td>{{$pic->id}}</td>
                    <td><img src="{{$pic->path}}" style="width:100px;"></td>
                    <td>{{$pic->create_time}}</td>
                    <td class="center">
                        <a class="btn btn-danger" href="#" onclick="Picture.del({{$pic->id}})">
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