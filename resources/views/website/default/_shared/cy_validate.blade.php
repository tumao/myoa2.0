@if(isset($data['isHomePage']))
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<script type="text/javascript" src="/default/app/js/website-vehicle.js"></script>
<style type="text/css">
	.search_value{
		padding-top: 50px;
		padding-left: 60px;
	}
	.att ul{
		width: 800px;
	}
	.btn.btn-default.search_it{
		float: right;
		margin-top: 20px;
		margin-right: 50px;
	}
</style>
@endif
<div class="search_box">
	<span>从</span>	<input id="from" type="text" placeholder="起运地" value="{{$data['checked']['from']}}">
	<span>到</span> <input id="to" type="text" placeholder="目的地"  value="{{$data['checked']['to']}}">
	@if(!isset($data['isHomePage']))
	<button id="search" class="btn btn-default search_it" type="button">搜索车源</button>
	@endif
</div>
<div class="tags">
	<div class="att">
		<div class="att_key">车辆类型:</div>
		<div class="att_val vehicle_type">
			<ul>
				<li data-vehicle-type="0"
					class="
							@if(empty($data['checked']['vehicle_type']))
								check
							@endif

				">不限</li>
				@foreach($data['vehicle_type'] as $item)
				<li data-vehicle-type="{{$item->id}}"
					class="
							@if(!empty($data['checked']['vehicle_type']) && $data['checked']['vehicle_type'] == $item->id)
								check
							@endif

				">{{$item->type_name}}</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="att">
		<div class="att_key">车体状况:</div>
		<div class="att_val vehicle_body_type">
			<ul>
				<li data-vehicle-body-type="0"
					class="@if(empty($data['checked']['vehicle_body_type']))
								check
							@endif">不限</li>
				@foreach($data['vehicle_body_type'] as $item)
				<li data-vehicle-body-type="{{$item->id}}"
					class="@if(!empty($data['checked']['vehicle_body_type']) && $data['checked']['vehicle_body_type'] == $item->id)
								check
							@endif">{{$item->body_type_name}}</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="att">
		<div class="att_key">车身长度:</div>
		<div class="att_val vehicle_length">
			<ul>
				<li data-vehicle-length='0' class="@if(empty($data['checked']['vehicle_length']))
								check
							@endif">不限</li>
				@foreach($data['vehicle_length'] as $item)
				<li data-vehicle-length="{{$item['between']}}"
						class="@if(!empty($data['checked']['vehicle_length']) && $data['checked']['vehicle_length'] == $item['between'])
								check
							@endif">{{$item['name']}}</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="att">
		<div class="att_key">车辆载重:</div>
		<div class="att_val vehicle_weight">
			<ul>
				<li data-vehicle-weight='0' class="@if(empty($data['checked']['vehicle_weight']))
								check
							@endif">不限</li>
				@foreach($data['vehicle_weight'] as $item)
				<li data-vehicle-weight="{{$item['between']}}"
					class="@if(!empty($data['checked']['vehicle_weight']) && $data['checked']['vehicle_weight'] == $item['between'])
								check
							@endif">{{$item['name']}}</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>