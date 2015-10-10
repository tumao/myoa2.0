@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/merchandises.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<script type="text/javascript" src="/default/app/js/website-merchandise.js"></script>
<div class="containers">
	@include('website::_shared.user_left_menu')
	<div class="right_part">
		<div class="right_part_cell from"><span class='title'>起始地:</span>
			<select name="province" id="province">
				<option value="000">省份</option>
				@foreach($area['province'] as $item)
				<option value="{{$item->provinceID}}"
					@if($item->provinceID == $data['merchandise']->from['province'])
						selected="selected"
					@endif
				>{{$item->province}}</option>
				@endforeach
			</select>
			<select name="city" id="city">
				<option>城市</option>
				@foreach($area['city'] as $item)
				<option value="{{$item->cityID}}"
					@if($item->cityID == $data['merchandise']->from['city'])
						selected="selected"
					@endif
				>{{$item->city}}</option>
				@endforeach
			</select>
			<select name="area" id="area">
				<option value="000">区</option>
				@foreach($area['area'] as $item)
				<option value="{{$item->areaID}}"
					@if($item->areaID == $data['merchandise']->from['area'])
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
					@if($item->provinceID == $data['merchandise']->to['province'])
						selected="selected"
					@endif
				>{{$item->province}}</option>
				@endforeach
			</select>
			<select name="city" id="city">
				<option>城市</option>
				@foreach($area_2['city'] as $item)
				<option value="{{$item->cityID}}"
					@if($item->cityID == $data['merchandise']->to['city'])
						selected="selected"
					@endif
				>{{$item->city}}</option>
				@endforeach
			</select>
			<select name="area" id="area">
				<option value="000">区</option>
				@foreach($area_2['area'] as $item)
				<option value="{{$item->areaID}}"
				@if($item->areaID == $data['merchandise']->to['area'])
						selected="selected"
					@endif
				>{{$item->area}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>发货日期:</span><span><input id="merchandise_date" type="text" value="{{$data['merchandise']->merchandise_date}}" /></span></div>
		<div class="right_part_cell"><span class='title'>联系人:</span><span><input id="contact_name" type="text" value="{{$data['merchandise']->contact_name}}" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input id="phone" type="text" value="{{$data['merchandise']->phone}}" /></span></div>
		<div class="right_part_cell"><span class='title'>货物名称:</span><span><input id="merchandise_name" type="text" value="{{$data['merchandise']->merchandise_name}}" /></span></div>
		<div class="right_part_cell"><span class='title'>货物类型:</span>
			<select id="merchandise_type">
				@foreach($data['merchandise_type'] as $item)
				<option value="{{$item->id}}"
				@if($item->id == $data['merchandise']->merchandise_type)
					selected="selected"
				@endif
				>{{$item->type_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>运输方式:</span>
			<select id="merchandise_shipping_method">
				@foreach($data['merchandise_shipping_method'] as $item)
				<option value="{{$item->id}}"
				@if($item->id == $data['merchandise']->merchandise_shipping_method)
					selected="selected"
				@endif
				>{{$item->shipping_method}}</option>
				@endforeach
			</select>
		</div>
		<div class="right_part_cell"><span class='title'>货物重量:</span><span><input id="merchandise_weight" type="text" value="{{$data['merchandise']->merchandise_weight}}" /></span></div>
		<div class="right_part_cell"><span class='title'>货物体积:</span><span><input id="merchandise_volume" type="text" value="{{$data['merchandise']->merchandise_volume}}" /></span></div>
		<div class="right_part_cell"><span class='title'>备注:</span><span><input id="info" type="text" value="{{$data['merchandise']->info}}" /></span></div>
		<button onclick="Merchandise.edit({{$data['merchandise']->id}})" class="submit">保存</button>
	</div>
</div>
@stop