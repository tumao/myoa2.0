<form id="group-form" name="group-form" method="GET" action="#" target="_top">
	<p><span>*</span><label>组名称:<input name="groupname" type="text" value="{{$data['group']['name']}}" /></label></p>
	@foreach($data['permissions'] as $permission)
	<p>
		<label>
			<input name="permission-group" type="checkbox" value='{{$permission['code']}}' @if(isset($permission['checked']) && $permission['checked'] == true ) checked @endif>{{$permission['name']}}
		</label>
	</p>
	@endforeach
</form>