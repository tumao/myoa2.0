@extends('default.main')
@section('content')
<script src="/default/app/js/menu.js"></script>
<div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><a href="#" onclick="Menu.form()"><i class="glyphicon glyphicon-plus-sign"></i>添加</a></h2>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>菜单ID</th>
                    <th>菜单名</th>
                    <th>图标</th>
                    <th>父ID</th>
                    <th>排序</th>
                    <th>路径</th>
                    <th>操作</th>
                </tr>
            </thead>
            @foreach($menuList as $listGroup)
            <tbody style="border-top:3px solid gray;">
               @foreach($listGroup as $item)
                <tr id='row_{{$item->id}}'>
                    <td>{{$item->id}}</td>
                    <td style="padding-left:{{40*$item->level}}px;">{{$item->name}}</td>
                    <td>{{$item->icon}}</td>
                    <td>{{$item->root}}</td>
                    <td>{{$item->sort}}</td>
                    <td>{{$item->path}}</td>
                    <td class="center">
                        <a class="btn btn-warning" href="#" onclick="Menu.add_son_menu({{$item->id}}, {{$item->id}},{{$item->level}})">
                            <i class="glyphicon glyphicon-qrcode icon-white"></i>
                            添加子菜单
                        </a>

                        <a class="btn btn-info" href="#" onclick="Menu.edit({{$item->id}})">
                            <i class="glyphicon glyphicon-edit icon-white"></i>
                            编辑
                        </a>
                        <a class="btn btn-danger" href="#" onclick="Menu.del({{$item->id}})">
                            <i class="glyphicon glyphicon-trash icon-white"></i>
                            删除
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
            @endforeach
        </table>
        <!-- 分页开始 -->
      <!--   <div class="row">
            <div class="col-md-12 center-block">
                <nav>
                  <ul class="pagination pagination-sm">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
            </div>
        </div> -->
        <!-- 分页结束 -->
        <input type="hidden" id="menu_cat" value="{{$cat}}">
    </div>
</div>
@stop
