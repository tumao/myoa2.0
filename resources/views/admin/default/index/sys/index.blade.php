@extends('default.main')

@section('content')
<style type="text/css">
	.list_cell{
		margin-top: 15px;
	}
	.title{
		font-weight: bold;
	}
</style>
<div class="list">
	<div class="list_cell">
		<span class="title">操作系统：</span><span>{{$data['os']}}</span>
	</div>
	<div class="list_cell">
		<span class="title">服务器及版本：</span><span>{{$data['server']}}</span>
	</div>
	<div class="list_cell">
		<span class="title">php版本：</span><span>{{$data['phpversion']}}</span>
	</div>
	<div class="list_cell">
		<span class="title">HOME:</span><span>{{$data['home']}}</span>
	</div>
	<div class="list_cell">
		<span class="title">入口文件:</span><span>{{$data['file_root']}}</span>
	</div>
</div>

@stop