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
		<div class="search_tag">
			<span>订单详情</span>
		</div>
		<div class="search_result">
			<div class="search_result_left">
				<div class="cell plate_number">
					<span class="s_title">车牌号码：</span>
					<span class="s_value">{{$data['detail']->plate_number}}</span>
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
					<span class="s_title">车辆类型：</span>
					<span class="s_value">{{$data['detail']->vehicle_type}}</span>
				</div>
				<div class="cell">
					<span class="s_title">车身类型：</span>
					<span class="s_value">{{$data['detail']->vehicle_body_type}}</span>
				</div>
				<div class="cell">
					<span class="s_title">车辆长度：</span>
					<span class="s_value">{{$data['detail']->vehicle_length}}米</span>
				</div>
				<div class="cell">
					<span class="s_title">车辆载重：</span>
					<span class="s_value">{{$data['detail']->vehicle_weight}}吨</span>
				</div>
				<div class="cell">
					<span class="s_title">常驻城市：</span>
					<span class="s_value">{{$data['location']['province']}}-{{$data['location']['city']}}-{{$data['location']['area']}}</span>
				</div>
				<div class="cell">
					<span class="s_title">补充说明：</span>
					<span class="s_value">{{$data['detail']->info}}</span>
				</div>
				<div class="cell contact_user">
					<span class="s_title">联系人：</span>
					<span class="s_value">{{$data['detail']->driver_name}}</span>
				</div>
				<div class="cell contact_phone">
					<span class="s_title">联系电话：</span>
					<span class="s_value">{{$data['detail']->phone}}</span>
				</div>
				<div class="cell contact_user">
					<span class="s_title">货主：</span>
					<span class="s_value">{{$data['merchandise_user']}}</span>
				</div>
				<div class="cell contact_phone">
					<span class="s_title">货主联系电话：</span>
					<span class="s_value">{{$data['merchandise_phone']}}</span>
				</div>
				<div class="cell">
					<!-- <button class="order_button" onclick="Vehicle.addOrder({{$data['detail']->id}},{{$data['detail']->user_id}})">确认订单</button> -->
				</div>
			</div>
			<div class="search_result_right">
				<img src="/default/app/img/qrcode.png">
			</div>
		</div>
	</div>
</div>
@stop