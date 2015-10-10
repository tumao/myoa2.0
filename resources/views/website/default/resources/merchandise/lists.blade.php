@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<script type="text/javascript" src="/default/app/js/website-merchandise.js"></script>
<div class="containers">
	<div class="tag">
		<div class="search_box">
			<span>从</span>	<input id="from" type="text" placeholder="起运地" value="{{$data['checked']['from']}}">
			<span>到</span> <input id="to" type="text" placeholder="目的地" value="{{$data['checked'][
			'to']}}">
			<button id="search" class="btn btn-default search_it" type="button">搜索货源</button>
		</div>
		<div class="tags">
			<div class="att">
				<div class="att_key">货物类型:</div>
				<div class="att_val merchandise_type">
					<ul>
						<li data-merchandise-type="0"
							@if(empty($data['checked']['merchandise_type']))
								class="check"
							@endif
						>不限</li>
						@foreach($data['mer_type'] as $item)
						<li data-merchandise-type="{{$item->id}}"
							@if(!empty($data['checked']['merchandise_type']) && $data['checked']['merchandise_type'] == $item->id)
								class="check"
							@endif

						>{{$item->type_name}}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="att">
				<div class="att_key">运输类型:</div>
				<div class="att_val merchandise_shipping_method">
					<ul>
						<li data-merchandise-shipping-method="0"
							@if(empty($data['checked']['merchandise_shipping_method']))
								class="check"
							@endif
						>不限</li>
						@foreach($data['mer_shipping_type'] as $item)
						<li data-merchandise-shipping-method="{{$item->id}}"
							@if(!empty($data['checked']['merchandise_shipping_method']) && $data['checked']['merchandise_shipping_method'] == $item->id)
								class="check"
							@endif
						>{{$item->shipping_method}}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="search_tag">
			<span>搜索结果</span>
		</div>
		<div class="search_result">
		@if(!empty($data['mer']))
			@foreach($data['mer'] as $item)
				<div class="sr_cell" data-cell-id="{{$item->id}}">
					<div class="sr_title"><span>{{$item->merchandise_name}}</span></div>
					<div class="add_from_to">从 <span class="from">{{$item->from['province']}}-{{$item->from['city']}}-{{$item->from['area']}}</span> 到 <span class="to">{{$item->to['province']}}-{{$item->to['city']}}-{{$item->to['area']}}</span></div>
					<div class="sr_status">
						<span>{{$item->merchandise_type}}</span><span>{{$item->merchandise_shipping_method}}</span><span>{{$item->merchandise_weight}}吨</span><span>{{$item->merchandise_volume}}立方米</span>
					</div>
					<div class="additional">
						补充说明：{{$item->info}}
					</div>
					<div class="contact">
						<span>联系人:{{$item->contact_name}}</span>&nbsp;<span>联系电话:{{$item->phone}}</span>
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