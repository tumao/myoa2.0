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
	<p><span>&nbsp;</span><label>起运地&nbsp;&nbsp;:<input id="from_area_id" name="from_area_id" type="text" value="{{$mer['from_area_id']}}"></label></p>
	<p><span>&nbsp;</span><label>目的地&nbsp;&nbsp;:<input id="to_area_id" name="to_area_id" type="text" value="{{$mer['to_area_id']}}"></label></p>
	<p><span>&nbsp;</span><label>联系人&nbsp;&nbsp;:<input id="contact_name" name="contact_name" type="text" value="{{$mer['contact_name']}}"></label></p>
	<p><span>&nbsp;</span><label>发货时间:<input name="merchandise_date" type="text" value="{{$mer['merchandise_date']}}"></label></p>
	<p><span>&nbsp;</span><label>联系电话:<input name="phone" type="text" value="{{$mer['phone']}}"></label></p>
	<p><span>&nbsp;</span><label>货物名称:<input name="merchandise_name" type="text" value="{{$mer['merchandise_name']}}"></label></p>
	<p><span>&nbsp;</span><label>货物类型:<select id="merchandise_type" name="merchandise_type">
				<option value="1">轻货</option>
				<option value="2">重货</option>
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>运输类型:<select id='merchandise_shipping_method' name="merchandise_shipping_method">
				<option value="1">物流公司</option>
				<option value="2">整车配货</option>
				<option value="3">零担配货</option>
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
	<p><span>&nbsp;</span><label>用户id&nbsp;&nbsp;:<input name="user_id" type="text" value="{{$mer['user_id']}}"></label></p>
</form>