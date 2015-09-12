@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<div class="containers">
	@include('website::_shared.user_left_menu')
		<div class="right_part">
		<div class="right_part_cell"><span class='title'>用户邮箱:</span><span>admin@admin.com</span></div>
		<div class="right_part_cell"><span class='title'>用户姓名:</span><span><input type="text" value="李明" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input type="text" value="13946312241 " /></span></div>
		<button class="submit">保存</button>
	</div>
</div>
@stop