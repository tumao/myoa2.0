@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<script type="text/javascript" src="/default/app/js/website-vehicle.js"></script>
<style type="text/css">
	.check{
		color: #ff6600;
	}
</style>
<div class="containers">
	<div class="tag">
		@include('website::_shared.cy_validate')
		<div class="search_tag">
			<span>搜索结果</span>
		</div>
		<div class="search_result">
		@if(!empty($data['vehicles']))
			@foreach($data['vehicles'] as $item)
			<div class="sr_cell" data-cell-id="{{$item->id}}">
				<div class="sr_title"><span>{{$item->plate_number}}</span></div>
				<div class="add_from_to">从 <span class="from">{{$item->from['province']}}-{{$item->from['city']}}-{{$item->from['area']}}</span> 到 <span class="to">{{$item->to['province']}}-{{$item->to['city']}}-{{$item->to['area']}}</span></div>
				<div class="sr_status">
					<span>{{$item->vehicle_type}}</span><span>{{$item->vehicle_body_type}}</span><span>{{$item->vehicle_length}}米</span><span>{{$item->vehicle_weight}}吨</span>
					<span>常驻地址:{{$item->location}}</span>
				</div>
				<div class="additional">
					补充说明：{{$item->info}}
				</div>
				<div class="contact">
					<span>联系人:{{$item->driver_name}}</span><span>&nbsp;&nbsp;联系电话:{{$item->phone}}</span>
				</div>
			</div>
			@endforeach
		@else
			搜索结果为空
		@endif
		</div>
		<div class="page">
		@if($data['checked']['page']>1)
		<a class="up_page" href="javascript:void(0)">上一页</a>
		@endif
		@if($data['sum_page'] > 1 && $data['sum_page'] <=5)
			@for($i=1; $i<=$data['sum_page']; $i++)
			<a href="javascript:void(0)" data-page="{{$i}}"
				class="npage @if($data['checked']['page'] == $i)
						checkedon
						@endif
				"
			>{{$i}}</a>
			@endfor
		@elseif($data['sum_page'] > 5)
			@for($i=-2; $i<=$data['checked']['page']; $i++)
			<a href="javascript:void(0)" data-page="{{$i}}"
				class="npage @if($data['checked']['page'] -2 == $i)
						checkedon
						@endif
				"
			>{{$data['checked']['page'] + $i}}</a>
			@endfor
		@endif
		@if($data['checked']['page'] < $data['sum_page'])
		<a class="down_page" href="javascript:void(0)">下一页</a>
		@endif
		<input id="sum_page" type="hidden" value="{{$data['sum_page']}}" />
		</div>
	</div>
</div>
@stop