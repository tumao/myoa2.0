@extends('default.main')
@section('content')
<script src="/default/app/js/vehicle.js"></script>
<div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><a href="#" onclick="Vehicle.form()"><i class="glyphicon glyphicon-plus-sign"></i>添加</a></h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>从</th>
                    <th>到</th>
                    <th>司机</th>
                    <th>联系电话</th>
                    <th>车牌</th>
                    <th>车辆类型</th>
                    <th>车体状况</th>
                    <th>车长</th>
                    <th>载重</th>
                    <th>location_id</th>
                    <th>备注</th>
                    <th>账户id</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $x)
                <tr id='row_{{$x->id}}'>
                    <td>{{$x->id}}</td>
                    <td>{{$x->from_area_id}}</td>
                    <td>{{$x->to_area_id}}</td>
                    <td>{{$x->phone}}</td>
                    <td>{{$x->plate_number}}</td>
                    <td>{{$x->vehicle_type}}</td>
                    <td>{{$x->vehicle_body_type}}</td>
                    <td>{{$x->vehicle_length}}</td>
                    <td>{{$x->vehicle_weight}}</td>
                    <td>{{$x->location_id}}</td>
                    <td>{{$x->info}}</td>
                    <td>{{$x->user_id}}</td>
                    <td>{{$x->create_time}}</td>
                    <td class="center">
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