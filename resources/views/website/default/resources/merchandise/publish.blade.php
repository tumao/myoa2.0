@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<div class="containers">
	@include('website::_shared.publish_left_menu')
	<div class="right_part">
		<div class="right_part_cell"><span class='title'>起始地:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>目的地:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>发货日期:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>联系人:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货物名称:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货物类型:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>运输方式:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货物重量:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>货物体积:</span><span><input type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>原始密码:</span><span><input type="text" value="" /></span></div>
		<button class="submit">保存</button>
	</div>
</div>
@stop