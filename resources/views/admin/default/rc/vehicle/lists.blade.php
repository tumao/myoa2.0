@extends('default.main')
@section('content')
<script src="/default/app/js/vehicle.js"></script>
<div class="box-inner">
    <div class="box-header well" data-original-title="">
        <!-- <h2><a href="javascript:void(0)" onclick="Vehicle.form()"><i class="glyphicon glyphicon-plus-sign"></i>添加</a></h2> -->
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>从</th>
                    <th>到</th>
                    <td>司机姓名</td>
                    <th>联系电话</th>
                    <th>车牌</th>
                    <th>车辆类型</th>
                    <th>车体状况</th>
                    <th>车长</th>
                    <th>载重</th>
                    <th>地址</th>
                    <th>备注</th>
                    <!-- <th>账户id</th> -->
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists as $x)
                <tr id='row_{{$x->id}}'>
                    <td>{{$x->id}}</td>
                    <td>{{$x->from['province']}}-{{$x->from['city']}}-{{$x->from['area']}}</td>
                    <td>{{$x->to['province']}}-{{$x->to['city']}}-{{$x->to['area']}}</td>
                    <td>{{$x->driver_name}}</td>
                    <td>{{$x->phone}}</td>
                    <td>{{$x->plate_number}}</td>
                    <td>{{$x->vehicle_type}}</td>
                    <td>{{$x->vehicle_body_type}}</td>
                    <td>{{$x->vehicle_length}}</td>
                    <td>{{$x->vehicle_weight}}</td>
                    <td>{{$x->location_id}}</td>
                    <td>{{$x->info}}</td>
                    <!-- <td>{{$x->user_id}}</td> -->
                    <td>{{$x->create_time}}</td>
                    <td class="center">
                        <a class="btn btn-info" href="#" onclick="Vehicle.edit({{$x->id}})">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            编辑
                        </a>
                        <a class="btn btn-danger" href="#" onclick="Vehicle.delete({{$x->id}})">
                            <i class="glyphicon glyphicon-trash icon-white"></i>
                            删除
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12 center-block">
                <div class="dataTables_paginate paging_bootstrap pagination">
                    <ul class="pagination">
                        @if($cur_page-1 > 0)
                        <li class="prev">
                            <a href="/admin/rc/vehicle?page={{$cur_page-1}}">← Previous</a>
                        </li>
                        @endif
                        @for($i=1; $i <= $sum_page; $i++ )
                        <li @if($i== $cur_page) class="active" @endif>
                            <a href="/admin/rc/vehicle?page={{$i}}">{{$i}}</a>
                        </li>
                        @endfor
                        @if($cur_page +1 <= $sum_page )
                        <li class="next">
                            <a href="/admin/rc/vehicle?page={{$cur_page+1}}">Next → </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop