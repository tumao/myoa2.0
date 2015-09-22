@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<script type="text/javascript" src="/default/app/js/website-merchandise.js"></script>
<div class="containers">
	@include('website::_shared.publish_left_menu')
	<div class="right_part">
		@include('default._shared.areaSelect')
		<div class="right_part_cell"><span class='title'>发货日期:</span><span><input id="merchandise_date" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>联系人:</span><span><input id="contact_name" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input id="phone" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货物名称:</span><span><input id="merchandise_name" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货物类型:</span>
			<select id="merchandise_type">
				@foreach($mer['merchandise_type'] as $item)
				<option value="{{$item->id}}">{{$item->type_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>运输方式:</span>
			<select id="merchandise_shipping_method">
				@foreach($mer['merchandise_shipping_method'] as $item)
				<option value="{{$item->id}}">{{$item->shipping_method}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>货物重量:</span><span><input id="merchandise_weight" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货物体积:</span><span><input id="merchandise_volume" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>备注:</span><span><input id="info" type="text" value="" /></span></div>
		<button onclick="Merchandise.add()" class="submit">保存</button>
	</div>
</div>
@stop