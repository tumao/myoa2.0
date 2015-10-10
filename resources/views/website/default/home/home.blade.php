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
					<li class="active" data-slide-to="0" data-target="#mycarousel">
					</li>
					<li data-slide-to="1" data-target="#mycarousel">
					</li>
					<li data-slide-to="2" data-target="#mycarousel">
					</li>
					<li data-slide-to="3" data-target="#mycarousel">
					</li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<img alt="" src="/default/app/img/jm.jpg" style="width:100%">
					</div>
					<div class="item">
						<img alt="" src="/default/app/img/jm.jpg">
					</div>
					<div class="item">
						<img alt="" src="/default/app/img/jm.jpg">
					</div>
					<div class="item">
						<img alt="" src="/default/app/img/jm.jpg">
					</div>
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
<div id="shortcut">
	<div class="shortcut-content">
		<div class="content-left-part">
			<div class="shortcut-top">
				<span>最新货源信息</span>
				<a href="/merchandise" title="">更多>></a>
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
			window.location.href = '/merchandise/detail/'+merchandise;
		});
		$('.list-cell.vehicle').click(function(){
			var vehicle = $(this).attr('data-vehicle-id');
			window.location.href = '/vehicles/detail/'+vehicle;
		});
	})
</script>
@stop