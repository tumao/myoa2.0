<!-- nav start -->
<div id="header">
	<div class="content">
		<div class="logo">
			<a href="" title=""><img src="/default/app/img/logo49.jpg" alt="货运大师"> 货运大师</a>
		</div>
		<div class="nav">
			<ul>
				@foreach($menu['main_menu'] as $item)
				<li  @if($item['active']) class="active" @endif><a href="{{$item['path']}}" title="">{{$item['name']}}</a></li>
				@endforeach
			</ul>
		</div>
		<div class="nav-right">
			<ul>
				@if(!$menu['user'])
				<li><a href="/user/register" title="注册">注册</a></li>
				<li><a href="#">/</a></li>
				<li><a href="/user/load" title="登录">登录</a></li>
				@else
				<li><a href="javascript:void(0)">{{$menu['user']->email}}</a></li>
				<li><a href="#">/</a></li>
				<li><a href="/logout">退出</a></li>
				@endif
			</ul>
		</div>
	</div>
</div><!-- nav end -->