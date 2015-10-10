@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<script type="text/javascript" src="/default/app/js/website-vehicle.js"></script>
<div class="containers">
		@include('website::_shared.user_left_menu')
	<div class="right_part">
		<div class="right_part_cell from"><span class='title'>起始地:</span>
			<select name="province" id="province">
				<option value="000">省份</option>
				@foreach($area['province'] as $item)
				<option value="{{$item->provinceID}}"
					@if($item->provinceID == $data['vehicle']->from['province'])
						selected="selected"
					@endif
				>{{$item->province}}</option>
				@endforeach
			</select>
			<select name="city" id="city">
				<option>城市</option>
				@foreach($area['city'] as $item)
				<option value="{{$item->cityID}}"
					@if($item->cityID == $data['vehicle']->from['city'])
						selected="selected"
					@endif
				>{{$item->city}}</option>
				@endforeach
			</select>
			<select name="area" id="area">
				<option value="000">区</option>
				@foreach($area['area'] as $item)
				<option value="{{$item->areaID}}"
					@if($item->areaID == $data['vehicle']->from['area'])
						selected="selected"
					@endif
				>{{$item->area}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell to"><span class='title'>目的地:</span>
			<select name="province" id="province">
				<option value="000">省份</option>
				@foreach($area_2['province'] as $item)
				<option value="{{$item->provinceID}}"
					@if($item->provinceID == $data['vehicle']->to['province'])
						selected="selected"
					@endif
				>{{$item->province}}</option>
				@endforeach
			</select>
			<select name="city" id="city">
				<option>城市</option>
				@foreach($area_2['city'] as $item)
				<option value="{{$item->cityID}}"
					@if($item->cityID == $data['vehicle']->to['city'])
						selected="selected"
					@endif
				>{{$item->city}}</option>
				@endforeach
			</select>
			<select name="area" id="area">
				<option value="000">区</option>
				@foreach($area_2['area'] as $item)
				<option value="{{$item->areaID}}"
				@if($item->areaID == $data['vehicle']->to['area'])
						selected="selected"
					@endif
				>{{$item->area}}</option>
				@endforeach
			</select>
		</div>

		<div class="right_part_cell"><span class='title'>联系人:</span><span><input id="driver_name" type="text" value="{{$data['vehicle']->driver_name}}" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input id="phone" type="text" value="{{$data['vehicle']->phone}}" /></span></div>
		<div class="right_part_cell"><span class='title'>车牌号:</span><span><input id="plate_number" type="text" value="{{$data['vehicle']->plate_number}}" /></span></div>
		<div class="right_part_cell"><span class='title'>货车类型:</span>
			<select id="vehicle_type">
				@foreach($data['vehicle_type'] as $item)
				<option value="{{$item->id}}"
					@if($item->id == $data['vehicle']->vehicle_type)
						selected="selected"
					@endif
				>{{$item->type_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>车体状况:</span>
			<select id="vehicle_body_type">
				@foreach($data['vehicle_body_type'] as $item)
				<option value="{{$item->id}}"
				@if($item->id == $data['vehicle']->vehicle_body_type)
					selected="selected"
				@endif
				>{{$item->body_type_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>车身长度:</span><span><input id="vehicle_length" type="text" value="{{$data['vehicle']->vehicle_length}}" /></span>米</div>
		<div class="right_part_cell"><span class='title'>车辆载重:</span><span><input id="vehicle_weight" type="text" value="{{$data['vehicle']->vehicle_weight}}" /></span>吨</div>
		<div class="right_part_cell location"><span class='title'>常驻地址:</span>
			<select name="province" id="province">
				<option value="000">省份</option>
				@foreach($area_3['province'] as $item)
				<option value="{{$item->provinceID}}"
					@if($item->provinceID == $data['vehicle']->location['province'])
						selected="selected"
					@endif
				>{{$item->province}}</option>
				@endforeach
			</select>
			<select name="city" id="city">
				<option>城市</option>
				@foreach($area_3['city'] as $item)
				<option value="{{$item->cityID}}"
					@if($item->cityID == $data['vehicle']->location['city'])
						selected="selected"
					@endif
				>{{$item->city}}</option>
				@endforeach
			</select>
			<select name="area" id="area">
				<option value="000">区</option>
				@foreach($area_3['area'] as $item)
				<option value="{{$item->areaID}}"
				@if($item->areaID == $data['vehicle']->location['area'])
						selected="selected"
					@endif
				>{{$item->area}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>备注信息:</span><span><input id="info" type="text" value="{{$data['vehicle']->info}}" /></span></div>
		<button onclick="Vehicle.edit({{$data['vehicle']->id}})" class="submit">保存</button>
	</div>

</div>


@stop