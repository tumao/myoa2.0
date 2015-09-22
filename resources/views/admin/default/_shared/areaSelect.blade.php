<div class="right_part_cell from"><span class='title'>起始地:</span>
	<select name="province" id="province">
		<option value="000">省份</option>
		@foreach($area['province'] as $item)
		<option value="{{$item->provinceID}}">{{$item->province}}</option>
		@endforeach
	</select>
	<select name="city" id="city">
		<option>城市</option>
	</select>
	<select name="area" id="area">
		<option value="000">区</option>
	</select>
</div>
<div class="right_part_cell to"><span class='title'>目的地:</span>
	<select name="province" id="province">
		<option value="000">省份</option>
		@foreach($area['province'] as $item)
		<option value="{{$item->provinceID}}">{{$item->province}}</option>
		@endforeach
	</select>
	<select name="city" id="city">
		<option value="000">城市</option>
	</select>
	<select name="area" id="area">
		<option value="000">区</option>
	</select>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		$('.from #province').change(function(){	//更换省份
			var pro_id = $('.from #province').val();
			changeArea('province',pro_id, 'from');
		});

		$('.from #city').change(function(){
			var city_id = $('.from #city').val();
			changeArea('city', city_id, 'from');
		});

		$('.to #province').change(function(){
			var pro_id = $('.to #province').val();
			changeArea('province', pro_id,'to');
		});

		$('.to #city').change(function(){
			var city_id = $('.to #city').val();
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
						var tag = '.'+location+' #city';
						$(tag).empty();
						for(var i=0; i<rp.length; i++){
							$(tag).append("<option value='"+rp[i].cityID+"'>"+rp[i].city+"</option>");
						}
					}else if(region == 'city'){	//返回的数据是地区
						var tag = '.'+location+' #area';
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