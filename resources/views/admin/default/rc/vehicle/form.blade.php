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
<form id="veh-form" class='veh-form' name='veh-form' action="#" method="post" target="_top">
	<p><span>&nbsp;</span><label>起运地&nbsp;&nbsp;:<input id="from_area_id" name="from_area_id" type="text" value="{{$vehicle['from_area_id']}}"></label></p>
	<p><span>&nbsp;</span><label>目的地&nbsp;&nbsp;:<input id="to_area_id" name="to_area_id" type="text" value="{{$vehicle['to_area_id']}}"></label></p>
	<p><span>&nbsp;</span><label>司机姓名:<input id="driver_name" name="driver_name" type="text" value="{{$vehicle['driver_name']}}"></label></p>
	<p><span>&nbsp;</span><label>联系电话:<input name="phone" type="text" value="{{$vehicle['phone']}}"></label></p>
	<p><span>&nbsp;</span><label>车牌号码:<input name="plate_number" type="text" value="{{$vehicle['plate_number']}}"></label></p>
	<p><span>&nbsp;</span><label>车辆类型:<select id="vehicle_type" name="vehicle_type">
				<option value="1">轻货</option>
				<option value="2">重货</option>
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>车身类型:<select id='vehicle_body_type' name="vehicle_body_type">
				<option value="1">物流公司</option>
				<option value="2">整车配货</option>
				<option value="3">零担配货</option>
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>车辆长度:<input name="vehicle_length" type="text" value="{{$vehicle['vehicle_length']}}"></label></p>
	<p><span>&nbsp;</span><label>车辆载重:<input name="vehicle_weight" type="text" value="{{$vehicle['vehicle_weight']}}"></label></p>
	<p><span>&nbsp;</span><label>常驻地址:<input name="location_id" type="text" value="{{$vehicle['location_id']}}"></label></p>
	<p><span>&nbsp;</span><label>补充说明:<input name="info" type="text" value="{{$vehicle['info']}}"></label></p>
	<p><span>&nbsp;</span><label>用户id&nbsp;&nbsp;:<input name="user_id" type="text" value="{{$vehicle['user_id']}}"></label></p>
</form>