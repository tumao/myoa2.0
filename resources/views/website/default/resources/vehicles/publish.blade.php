@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<script type="text/javascript" src="/default/app/js/website-vehicle.js"></script>
<div class="containers">
		@include('website::_shared.publish_left_menu')
	<div class="right_part">
		@include('default._shared.areaSelect')
		<div class="right_part_cell"><span class='title'>联系人:</span><span><input id="driver_name" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input id="phone" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>车牌号:</span><span><input id="plate_number" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货车类型:</span>
			<select id="vehicle_type">
				@foreach($vehicle['vehicle_type'] as $item)
				<option value="{{$item->id}}">{{$item->type_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>车体状况:</span>
			<select id="vehicle_body_type">
				@foreach($vehicle['vehicle_body_type'] as $item)
				<option value="{{$item->id}}">{{$item->body_type_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>车身长度:</span><span><input id="vehicle_length" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>车辆载重:</span><span><input id="vehicle_weight" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>常驻地址:</span><span><input id="location_id" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>备注信息:</span><span><input id="info" type="text" value="" /></span></div>
		<button onclick="Vehicle.add()" class="submit">保存</button>
	</div>

</div>
@stop