@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<script type="text/javascript" src="/default/app/js/website-merchandise.js"></script>
<div class="containers">
	<div class="tag">
		<!-- <div class="search_box">
			<span>从</span>	<input id="from" type="text" placeholder="起运地" value="">
			<span>到</span> <input id="to" type="text" placeholder="目的地" value="">
			<button id="search" class="btn btn-default search_it" type="button">搜索货源</button>
		</div>
		<div class="tags">
			<div class="att">
				<div class="att_key">货物类型:</div>
				<div class="att_val merchandise_type">
					<ul>
						<li data-merchandise-type="0" class="check"
						>不限</li>
						@foreach($data['mer_type'] as $item)
						<li data-merchandise-type="{{$item->id}}"
						>{{$item->type_name}}</li>
						@endforeach
					</ul>
				</div>
			</div>
			<div class="att">
				<div class="att_key">运输类型:</div>
				<div class="att_val merchandise_shipping_method">
					<ul>
						<li data-merchandise-shipping-method="0" class="check" 
						>不限</li>
						@foreach($data['mer_shipping_type'] as $item)
						<li data-merchandise-shipping-method="{{$item->id}}"
						>{{$item->shipping_method}}</li>
						@endforeach
					</ul>
				</div>
			</div> -->
		</div>
		<div class="search_tag">
			<span>订单详情</span>
		</div>
		<div class="search_result">
			<div class="search_result_left">
				<div class="cell plate_number">
					<span class="s_title">货物名称：</span>
					<span class="s_value">{{$data['detail']->merchandise_name}}</span>
				</div>
				<div class="cell create_date">
					<span class="s_title">发布日期：</span>
					<span class="s_value">{{$data['detail']->create_time}}</span>
				</div>
				<div class="cell">
					<span class="s_title">出发地：</span>
					<span class="s_value">{{$data['detail']->from_area_id}}</span>
				</div>
				<div class="cell">
					<span class="s_title">目的地：</span>
					<span class="s_value">{{$data['detail']->to_area_id}}</span>
				</div>
				<div class="cell">
					<span class="s_title">发货日期：</span>
					<span class="s_value">{{$data['detail']->merchandise_date}}</span>
				</div>
				<div class="cell">
					<span class="s_title">货物类型：</span>
					<span class="s_value">{{$data['detail']->merchandise_type}}</span>
				</div>
				<div class="cell">
					<span class="s_title">运输方式：</span>
					<span class="s_value">{{$data['detail']->merchandise_shipping_method}}</span>
				</div>
				<div class="cell">
					<span class="s_title">货物重量：</span>
					<span class="s_value">{{$data['detail']->merchandise_weight}}吨</span>
				</div>
				<div class="cell">
					<span class="s_title">货物体积：</span>
					<span class="s_value">{{$data['detail']->merchandise_volume}}立方米</span>
				</div>
				<div class="cell">
					<span class="s_title">补充说明：</span>
					<span class="s_value">{{$data['detail']->info}}</span>
				</div>
				<div class="cell contact_user">
					<span class="s_title">联系人：</span>
					<span class="s_value">{{$data['detail']->contact_name}}</span>
				</div>
				<div class="cell contact_phone">
					<span class="s_title">联系电话：</span>
					<span class="s_value">{{$data['detail']->phone}}</span>
				</div>
				<div class="cell contact_user">
					<span class="s_title">司机：</span>
					<span class="s_value">{{$data['driver_name']}}</span>
				</div>
				<div class="cell contact_phone">
					<span class="s_title">司机联系电话：</span>
					<span class="s_value">{{$data['phone']}}</span>
				</div>
				<input type="hidden" id="user_id" value="{{$data['detail']->id}}" />
				<input type="hidden" id="driver_id" value="{{$data['driver_id']}}" />

				<div class="cell">
					<button class="order_button" onclick="Merchandise.addOrder({{$data['detail']->id}},{{$data['detail']->id}},{{$data['driver_id']}})">确认订单</button>
				</div>

			</div>
			<div class="search_result_right">
				<img src="/default/app/img/qrcode.png">
			</div>
		</div>
	</div>
</div>
@stop