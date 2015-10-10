<style type="text/css">
	.right_part_cell select{
		display: block;
		margin-left: 90px;
		margin-top: 10px;
	}
</style>
<div class="right_part_cell from"><span class='title'>起始地:</span>
	<select name="province" class="province">
		<option value="000">省份</option>
		@foreach($area['province'] as $item)
		<option value="{{$item->provinceID}}"
		@if($item->provinceID == $vehicle->from['province'])
		selected="selected" 
		@endif
		>{{$item->province}}</option>
		@endforeach
	</select>
	<select name="city" class="city">
		<option>城市</option>
		@foreach($area['city'] as $item)
		<option value="{{$item->cityID}}"
		@if($item->cityID == $vehicle->from['city'])
		selected="selected" 
		@endif
		>{{$item->city}}</option>
		@endforeach
	</select>
	<select name="area" class="area"  id="from_area_id">
		<option value="000">区</option>
		@foreach($area['area'] as $item)
		<option value="{{$item->areaID}}"
		@if($item->areaID == $vehicle->from['area'])
		selected="selected" 
		@endif
		>{{$item->area}}</option>
		@endforeach
	</select>
</div>
<div class="right_part_cell to"><span class='title'>目的地:</span>
	<select name="province" class="province">
		<option value="000">省份</option>
		@foreach($area_2['province'] as $item)
		<option value="{{$item->provinceID}}"
		@if($item->provinceID == $vehicle->to['province'])
		selected="selected" 
		@endif
		>{{$item->province}}</option>
		@endforeach
	</select>
	<select name="city" class="city">
		<option value="000">城市</option>
		@foreach($area_2['city'] as $item)
		<option value="{{$item->cityID}}"
		@if($item->cityID == $vehicle->to['city'])
		selected="selected" 
		@endif
		>{{$item->city}}</option>
		@endforeach
	</select>
	<select name="area" class="area"  id="to_area_id">
		<option value="000">区</option>
		@foreach($area_2['area'] as $item)
		<option value="{{$item->areaID}}"
		@if($item->areaID == $vehicle->to['area'])
		selected="selected" 
		@endif
		>{{$item->area}}</option>
		@endforeach
	</select>
</div>