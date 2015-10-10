<link rel="stylesheet" type="text/css" href="/app/css/menu.css">
<script src="/default/framework/bower_components/jquery/jquery.min.js"></script>

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
	<div>
		@include('default._shared.backendAreaSelect')
	</div>
	<p><span>&nbsp;</span><label>司机姓名:<input id="driver_name" name="driver_name" type="text" value="{{$vehicle['driver_name']}}"></label></p>
	<p><span>&nbsp;</span><label>联系电话:<input name="phone" type="text" value="{{$vehicle['phone']}}"></label></p>
	<p><span>&nbsp;</span><label>车牌号码:<input name="plate_number" type="text" value="{{$vehicle['plate_number']}}"></label></p>
	<p><span>&nbsp;</span><label>车辆类型:<select id="vehicle_type" name="vehicle_type">
				@foreach($vehicle->vehicle_types as $item)
				<option value="{{$item->id}}"
					@if($item->id == $vehicle['vehicle_type'])
					selected="selected"
					@endif
				>{{$item->type_name}}</option>
				@endforeach
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>车身类型:<select id='vehicle_body_type' name="vehicle_body_type">
				@foreach($vehicle->vehicle_body_types as $item)
				<option value="{{$item->id}}"
				@if($item->id == $vehicle['vehicle_body_type'])
					selected="selected"
					@endif
				>{{$item->body_type_name}}</option>
				@endforeach
			</select>
		</label>
	</p>
	<p><span>&nbsp;</span><label>车辆长度:<input name="vehicle_length" type="text" value="{{$vehicle['vehicle_length']}}"></label></p>
	<p><span>&nbsp;</span><label>车辆载重:<input name="vehicle_weight" type="text" value="{{$vehicle['vehicle_weight']}}"></label></p>
	<p><span>&nbsp;</span><label>常驻地址:<input name="location_id" type="text" value="{{$vehicle['location_id']}}"></label></p>
	<p><span>&nbsp;</span><label>补充说明:<input name="info" type="text" value="{{$vehicle['info']}}"></label></p>
	<input name="user_id" type="hidden" value="{{$vehicle['user_id']}}">
</form>
<script type="text/javascript">
$(document).ready(function(){
		$('.from .province').change(function(){	//更换省份
			var pro_id = $('.from .province').val();
			changeArea('province',pro_id, 'from');
		});

		$('.from .city').change(function(){
			var city_id = $('.from .city').val();
			changeArea('city', city_id, 'from');
		});

		$('.to .province').change(function(){
			var pro_id = $('.to .province').val();
			changeArea('province', pro_id,'to');
		});

		$('.to .city').change(function(){
			var city_id = $('.to .city').val();
			changeArea('city', city_id, 'to');
		});
		function changeArea(region, id, location){	//region (province, city), location ()
			var data ={};
			if(region == 'province'){
				data['provinceID'] = id;
			}else if(region == 'city'){
				data['cityID'] = id;
			}else{
				return false;
			}
			$.ajax({
				url  : '/get_areas',
				type : 'POST',
				dataType: 'json',
				data : data,
				success : function(rp){
					if(region == 'province')	// 返回的数据是城市
					{
						var tag = '.'+location+' .city';
						$(tag).empty();
						for(var i=0; i<rp.length; i++){
							$(tag).append("<option value='"+rp[i].cityID+"'>"+rp[i].city+"</option>");
						}
					}else if(region == 'city'){	//返回的数据是地区
						var tag = '.'+location+' .area';
						$(tag).empty();
						for(var i=0; i<rp.length; i++){
							$(tag).append("<option value='"+rp[i].areaID+"'>"+rp[i].area+"</option>");
						}
					}
				}
			})
		}
	})

</script>