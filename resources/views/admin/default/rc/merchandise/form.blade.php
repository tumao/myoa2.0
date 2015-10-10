<link rel="stylesheet" type="text/css" href="/app/css/menu.css">
<style type="text/css">
	input{
		margin-left: 20px;
	}
	select{
		margin-left: 20px;
		width: 145px;
	}
</style>
<form id="mer-form" class='mer-form' name='mer-form' action="#" method="post" target="_top">
	<div class="area_select">
	</div>
	<p><span>&nbsp;</span><label>联系人&nbsp;&nbsp;:<input id="contact_name" name="contact_name" type="text" value="{{$mer['contact_name']}}"></label></p>
	<p><span>&nbsp;</span><label>发货时间:<input name="merchandise_date" type="text" value="{{$mer['merchandise_date']}}"></label></p>
	<p><span>&nbsp;</span><label>联系电话:<input name="phone" type="text" value="{{$mer['phone']}}"></label></p>
	<p><span>&nbsp;</span><label>货物名称:<input name="merchandise_name" type="text" value="{{$mer['merchandise_name']}}"></label></p>
	<p><span>&nbsp;</span><label>货物类型:<select id="merchandise_type" name="merchandise_type">
				@foreach($mer->merchandise_type as $item)
				<option value="{{$item->id}}"
					@if($item->id == $mer['merchandise_type'])
						selected="selected"
					@endif
				>{{$item->type_name}}</option>
				@endforeach
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>运输类型:<select id='merchandise_shipping_method' name="merchandise_shipping_method">
				@foreach($mer->merchandise_shipping_method as $item)
				<option value="{{$item->id}}"
					@if($item->id == $mer['merchandise_shipping_method'])
						selected="selected"
					@endif
				>{{$item->shipping_method}}</option>
				@endforeach
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>货物重量:<input name="merchandise_weight" type="text" value="{{$mer['merchandise_weight']}}"></label></p>
	<p><span>&nbsp;</span><label>货物体积:<input name="merchandise_volume" type="text" value="{{$mer['merchandise_volume']}}"></label></p>
	<p><span>&nbsp;</span><label>货物状态:<select id='merchandise_status' name="merchandise_status">
				<option value="1">待配货</option>
				<option value="2">已发货</option>
				<option value="3">已送达</option>
				<option value="4">已失效</option>
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>补充说明:<input name="info" type="text" value="{{$mer['info']}}"></label></p>
	<!-- <p><span>&nbsp;</span><label>用户id&nbsp;&nbsp;:<input name="user_id" type="text" value="{{$mer['user_id']}}"></label></p> -->
	<input name="user_id" type="hidden" value="{{$mer['user_id']}}">
</form>