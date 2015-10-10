@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/register.css">
<script type="text/javascript" src="/default/app/js/register.js"></script>
<div class="containers">
	<div class="right_part">
		<div style="font-weight:bold; font-size: 50px;">用户登录</div>
		<div class="right_part_cell"><span class='title'>*邮&nbsp;&nbsp;箱:</span><span><input id="email" type="text" value="" /></span></div>
		<div class="right_part_cell"><span class='title'>*密&nbsp;&nbsp;码:</span><span><input id="password" type="password" value="" /></span></div>
		<div> <input id="remember" type="checkbox" style="margin-left:40px;margin-top:20px;">&nbsp;自动登录 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="#"><!-- 忘记密码？ --></a></span></div>
		<button onclick="User.load()" class="submit" style="margin-top:20px;">登录</button>
	</div>
	<div class="qrcode">
		<img src="/default/app/img/qrcode.png">
	</div>


</div>
@stop