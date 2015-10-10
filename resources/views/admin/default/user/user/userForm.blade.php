<link rel="stylesheet" type="text/css" href="/default/app/css/user.css">
<form id="user-form" class='user-form' name='user-form' action="#" method="post" target="_top">
	<p><span>*</span><label>用户名&nbsp;： <input id="user-form-name" name="username" type="text" value={{$data['user']['username']}}></label></p>
	<p><span>*</span><label>邮&nbsp;箱&nbsp;： <input id="user-form-email" name="email" type="text" value={{$data['user']['email']}}></label></p>
	<!-- <p><span>  </span><label>真实姓名： <input id="first_name" name="first_name" type="text" value={{$data['user']['first_name']}}></label></p> -->

	@if(!$data['user']['id'])
	<p><span>*</span><label>初始密码：<input id="user-password" name="password" type="text"></label></p>
	@endif
		<label style="color:gray; font-size:12px;">注：(*)为必填项</label>

	<hr/>

	<p><label>用户组 ： </label></p>
	<div class='user-form-group'>
		@foreach( $data['group'] as $group)
			<p>
				<input name="user-group" type="radio" value= {{$group->name}}  @if($group->checked == true) checked @endif>
				{{$group->name}}
			</p>
		@endforeach
	</div>
</form>
