@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/register.css">
<script type="text/javascript" src="/default/app/js/register.js"></script>
<div class="containers">
	<div class="right_part">
		<div style="font-weight:bold; font-size: 50px;">用户注册</div>
		<div class="right_part_cell"><span class='title'>*邮&nbsp;&nbsp;箱:</span><span><input id="email" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>*昵&nbsp;&nbsp;称:</span><span><input id="nickname" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>*密&nbsp;&nbsp;码:</span><span><input id="password" type="password" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>*确认密码:</span><span><input id="password_make_sure" type="password" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input id="phone" type="text" value="" /></span></div>
		<button onclick="Register.add()" class="submit" style="margin-top:20px;">保存</button>
	</div>


</div>
@stop