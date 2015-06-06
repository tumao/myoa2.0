<form id="role-form" name="group-form" method="GET" action="#" target="_top" style="margin-left:17px;">
	<p><span>*</span><label>角色英文名称:&nbsp;<input name="rolename" type="text" value="{{$data['group']['name']}}" /></label></p>
	<p><span>*</span><label>角色中文名称:&nbsp;<input name="role_display_name" type="text" value="{{$data['group']['display_name']}}" /></label></p>
	<hr/>
	@foreach($data['permissions'] as $permission)
	<p>
		<label>
			<input name="permission-group" type="checkbox" value='{{$permission['name']}}' @if(isset($permission['checked']) && $permission['checked'] == true ) checked @endif>{{$permission['display_name']}}
		</label>
	</p>
	@endforeach
</form>