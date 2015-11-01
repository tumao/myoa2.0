@extends('website::main')
@section('content')
<!-- scroll start -->
<style type="text/css">
	.list-cell:hover{
		cursor: pointer;
	}
	
</style>
<div class="scroll container-fluid">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="carousel slide" id="mycarousel">
				<ol class="carousel-indicators">
					@foreach($pic as $k => $v)
						<li @if($k== 0) class="active" @endif data-slide-to="{{$k}}" data-target="#mycarousel"></li>
					@endforeach
				</ol>
				<div class="carousel-inner">
					@foreach($pic as $k => $v)
					<div class="item @if($k==0) active @endif">
						<img alt="" src="{{$v->path}}" style="width:100%">
					</div>
					@endforeach
				</div>
				<a class="left carousel-control" href="#mycarousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#mycarousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
		</div>
	</div>
</div><!-- scroll end -->
<div class="search_form">
	<div class="search_button">
		<div class="button hy @if($data['checked']['tag'] == 'default') active @endif">
			搜索货源
		</div>
		<div class="button cy  @if($data['checked']['tag'] == 'cy') active @endif" style="border-top:1px solid">
			搜索车源
		</div>
		<div class="button fbxx" style="border-top:1px solid">
			发布信息
		</div>
	</div>
	<div class="search_value">
	@if($data['checked']['tag'] == 'default')
 		@include('website::_shared.hy_validate')
 		<button id="search" class="btn btn-default search_it" type="button">搜索货源</button>
 	@elseif($data['checked']['tag'] == 'cy')
 		@include('website::_shared.cy_validate')
 		<button id="search" class="btn btn-default search_it" type="button">搜索车源</button>
 	@endif
	</div>
</div>
<div id="shortcut">
	<div class="shortcut-content">
		<div class="content-left-part">
			<div class="shortcut-top">
				<span>最新货源信息</span>
				<a href="/merchandises" title="">更多>></a>
			</div>
			<div class="shortcut-content-list">
				@foreach($data['merchandise'] as $x)
				<div class="list-cell merchandise" data-merchandise-id="{{$x->id}}">
					<div class="cell-title">
						<span class="cell-title">{{$x->merchandise_name}}</span>
						<span class="cell-date">{{$x->create_time}}</span>
					</div>
					<div class="cell-content">
						<span>从 {{$x->from['province']}}-{{$x->from['city']}}-{{$x->from['area']}} 到 {{$x->to['province']}}-{{$x->to['city']}}-{{$x->to['area']}}</span>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="content-right-part">
			<div class="shortcut-top">
				<span>最新车源信息</span>
				<a href="/vehicles" title="">更多>></a>
			</div>
			<div class="shortcut-content-list">
				@foreach($data['vehicle'] as $x)
				<div class="list-cell vehicle" data-vehicle-id="{{$x->id}}">
					<div class="cell-title">
						<span class="cell-title">{{$x->plate_number}}</span>
						<span class="cell-date">{{$x->create_time}}</span>
					</div>
					<div class="cell-content">
						<span>从 {{$x->from['province']}}-{{$x->from['city']}}-{{$x->from['area']}} 到 {{$x->to['province']}}-{{$x->to['city']}}-{{$x->to['area']}}</span>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.list-cell.merchandise').click(function(){
			var merchandise = $(this).attr('data-merchandise-id');
			window.location.href = '/merchandises/detail/'+merchandise;
		});
		$('.list-cell.vehicle').click(function(){
			var vehicle = $(this).attr('data-vehicle-id');
			window.location.href = '/vehicles/detail/'+vehicle;
		});
		$('.hy').click(function(){
			window.location.href = '/home/default';
		});
		$('.cy').click(function(){
			window.location.href = '/home/cy';
		});
		$('.fbxx').click(function(){
			window.location.href = '/publish/vehicle';
		});
	});

</script>
@stop