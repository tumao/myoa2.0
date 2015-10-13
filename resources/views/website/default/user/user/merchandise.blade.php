@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<div class="containers">
	@if($menu['sub_menu'])
		@include('website::_shared.left_menu')
	@endif
	<div class="right_part" style="margin-bottom:20px;">
	@foreach($data['merchandise'] as $item)
		<div class="right_vehcile_cell">
			<span class="plate_number">{{$item->merchandise_name}}</span> <span class="area">从 {{$item->from['province']}} {{$item->from['city']}} {{$item->from['area']}} 到 {{$item->to['province']}} {{$item->to['city']}} {{$item->to['area']}}</span>
			<a href="/user/merchandise/edit/{{$item->id}}">编辑</a>
		</div>
	@endforeach
	</div>
	@include('website::_shared.page')
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
			url = '/user/merchandise?';
			url = url + '&page=' + page;
			window.location.href = url;
		};
	});
</script>
@stop