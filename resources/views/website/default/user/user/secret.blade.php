@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<script type="text/javascript" src="/default/app/js/website-user.js"></script>
<div class="containers">
	@if($menu['sub_menu'])
		@include('website::_shared.left_menu')
	@endif
	<div class="right_part">
		<div class="right_part_cell"><span class='title'>原始密码:</span><span><input id="old_password" type="password" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>新&nbsp;&nbsp;密&nbsp;&nbsp;码:</span><span><input id="password" type="password" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>确认新密码:</span><span><input id="new_password" type="password" value="" /></span></div>
		<button onclick="User.secret()" class="submit">保存</button>
	</div>


</div>
@stop