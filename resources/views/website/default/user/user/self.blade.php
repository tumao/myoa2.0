@extends('website::main')
@section('content')
<link rel="stylesheet" type="text/css" href="/default/app/css/vehicles.css">
<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<script type="text/javascript" src="/default/app/js/website-user.js"></script>
<div class="containers">
		@include('website::_shared.user_left_menu')
	<div class="right_part">
		<input id="email" type="hidden" value="{{$user->email}}" />
		<div class="right_part_cell"><span class='title'>用户邮箱:</span><span>{{$user->email}}</span></div>
		<div class="right_part_cell"><span class='title'>用户姓名:</span><span><input id="username" type="text" value="{{$user->username}}" /></span></div>
		<div class="right_part_cell"><span class='title'>联系电话:</span><span><input id="phone" type="text" value="{{$user->phone}} " /></span></div>
		<button class="submit" onclick="User.save()">保存</button>
	</div>

</div>
@stop