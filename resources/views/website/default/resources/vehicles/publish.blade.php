@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<script type="text/javascript" src="/default/app/js/website-vehicle.js"></script>
<div class="containers">
		@if($menu['sub_menu'])
			@include('website::_shared.left_menu')
		@endif
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
		<div class="right_part_cell"><span class='title'>车身长度:</span><span><input id="vehicle_length" type="text" value="" /></span>米</div>
		<div class="right_part_cell"><span class='title'>车辆载重:</span><span><input id="vehicle_weight" type="text" value="" /></span>吨</div>
		<div class="right_part_cell location"><span class='title'>常住地:</span>
			<select name="province" class="province">
				<option value="000">省份</option>
				@foreach($area['province'] as $item)
				<option value="{{$item->provinceID}}">{{$item->province}}</option>
				@endforeach
			</select>
			<select name="city" id="city">
				<option>城市</option>
			</select>
			<select name="area" id="area">
				<option value="000">区</option>
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>备注信息:</span><span><input id="info" type="text" value="" /></span></div>
		<button onclick="Vehicle.add()" class="submit">保存</button>
	</div>

</div>
@stop