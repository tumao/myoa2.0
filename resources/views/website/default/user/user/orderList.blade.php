@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<div class="containers">
	@if($menu['sub_menu'])
		@include('website::_shared.left_menu')
	@endif
	<div class="right_part" style="margin-bottom:20px;">
	@foreach($data as $item)
		@if($item->order_type == 'merchandise')
		<div class="right_vehcile_cell">
			<span class="plate_number">货源</span> <span class="area">从 {{$item->merchandiseInfo->from_area_id}} 到 {{$item->merchandiseInfo->to_area_id}}</span><span style="margin-left:5px; font-size:12px; color:#ff6600;">({{$item->order_status}})</span>
			<a href="/user/order/mdetail/{{$item->merchandise_id}}">详情</a>
		</div>
		@elseif($item->order_type== 'vehicle')
		<div class="right_vehcile_cell">
			<span class="plate_number">车源</span> <span class="area">从 {{$item->vehicleInfo->from_area_id}} 到 {{$item->vehicleInfo->to_area_id}}</span> <span style="margin-left:5px; font-size:12px; color:#ff6600;">({{$item->order_status}})</span>
			<a href="/user/order/vdetail/{{$item->vehicle_id}}">详情</a>
		</div>
		@endif
	@endforeach
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var page = 1;
		page= $('.checkedon').attr('data-page');
		$('.page .npage').click(function(){
			page = $(this).attr('data-page');
			leap_page(page);
		});

		$('.page .up_page').click(function(){
			page = page -1;
			if(page<1){
				return false;
			}
			leap_page(page);
		});
		$('.page .down_page').click(function(){
			// var sum_page = $('#')
			page = parseInt(page)+1;
			leap_page(page);
		});

		function leap_page(page){
			var url;
			url = '/user/vehicle?';
			url = url + '&page=' + page;
			window.location.href = url;
		};
	});

</script>
@stop