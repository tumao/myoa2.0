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
		<div class="search_box">
			<span>从</span>	<input id="from" type="text" placeholder="起运地" value="{{$data['checked']['from']}}">
			<span>到</span> <input id="to" type="text" placeholder="目的地"  value="{{$data['checked']['to']}}">
			<button id="search" class="btn btn-default search_it" type="button">搜索车源</button>
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
		<div class="search_tag">
			<span>搜索结果</span>
		</div>
		<div class="search_result">
		@if(!empty($data['vehicles']))
			@foreach($data['vehicles'] as $item)
			<div class="sr_cell">
				<div class="sr_title"><span>{{$item->plate_number}}</span></div>
				<div class="add_from_to">从 <span class="from">{{$item->from['province']}}-{{$item->from['city']}}-{{$item->from['area']}}</span> 到 <span class="to">{{$item->to['province']}}-{{$item->to['city']}}-{{$item->to['area']}}</span></div>
				<div class="sr_status">
					<span>{{$item->vehicle_type}}</span><span>{{$item->vehicle_body_type}}</span><span>{{$item->vehicle_length}}米</span><span>{{$item->vehicle_weight}}吨</span>
					<span>常驻地址:{{$item->location}}</span>
				</div>
				<div class="additional">
					补充说明：{{$item->info}}
				</div>
				<div class="contact">
					<span>联系人:{{$item->driver_name}}</span><span>&nbsp;&nbsp;联系电话:{{$item->phone}}</span>
				</div>
			</div>
			@endforeach
		@else
			搜索结果为空
		@endif
		</div>
	</div>
</div>
@stop