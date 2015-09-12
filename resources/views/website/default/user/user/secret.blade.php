@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<div class="containers">
	@include('website::_shared.user_left_menu')
	<div class="right_part">
		<div class="right_part_cell"><span class='title'>原始密码:</span><span><input type="password" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>新&nbsp;&nbsp;密&nbsp;&nbsp;码:</span><span><input type="password" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>确认新密码:</span><span><input type="password" value="" /></span></div>
		<button class="submit">保存</button>
	</div>


</div>
@stop