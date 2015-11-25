$(document).ready(function(){
	var vehicle_type = 0;	//货车类型
	var vehicle_body_type = 0;	// 货车车身类型
	var vehicle_length = 0;
	var vehicle_weight = 0;
	var page = 1;

	vehicle_type = $('.vehicle_type .check').attr('data-vehicle-type');
	vehicle_body_type = $('.vehicle_body_type .check').attr('data-vehicle-body-type');
	vehicle_length = $('.vehicle_length .check').attr('data-vehicle-length');
	vehicle_weight = $('.vehicle_weight .check').attr('data-vehicle-weight');
	page= $('.checkedon').attr('data-page');

	$('.vehicle_type li').click(function(){
		vehicle_type = $(this).attr('data-vehicle-type');
		$('.vehicle_type .check').removeClass('check');
		$(this).addClass('check');
	});
	$('.vehicle_body_type li').click(function(){
		vehicle_body_type = $(this).attr('data-vehicle-body-type');
		$('.vehicle_body_type .check').removeClass('check');
		$(this).addClass('check');
	});
	$('.vehicle_length li').click(function(){
		vehicle_length = $(this).attr('data-vehicle-length');
		$('.vehicle_length .check').removeClass('check');
		$(this).addClass('check');
	});
	$('.vehicle_weight li').click(function(){
		vehicle_weight = $(this).attr('data-vehicle-weight');
		$('.vehicle_weight .check').removeClass('check');
		$(this).addClass('check');
	});
	$('.page .npage').click(function(){
		page = $(this).attr('data-page');
		leap_page(page);
	});

	$('.page .up_page').click(function(){
		page = page -1;
		if(page<1){
			return false;
		}
		leap_page(page);
	});
	$('.page .down_page').click(function(){
		// var sum_page = $('#')
		page = parseInt(page)+1;
		leap_page(page);
	});

	$('#search').click(function(){
		var from = $('#from').val();
		var to = $('#to').val();

		var url;
		url = '/vehicles?';
		url = url + 'vehicle_type=' + vehicle_type;
		url = url + '&vehicle_body_type=' + vehicle_body_type;
		url = url + '&vehicle_length=' + vehicle_length;
		url = url + '&vehicle_weight=' + vehicle_weight;
		url = url + '&from=' + from;
		url = url + '&to=' + to;
		window.location.href = url;
	});
	$('.sr_cell').click(function(){
		var id = $(this).attr('data-cell-id');
		window.location.href = '/vehicles/detail/'+id;
	});

	$('.location .province').change(function(){		//常住地级联选项-更改省份
		var pro_id = $('.location .province').val();
		changeArea('province',pro_id, 'location');
	});

	$('.location .city').change(function(){			//常住地级联选项-更改城市
		var city_id = $('.location .city').val();
		changeArea('city', city_id, 'location');
	});

	// 级联地址开始

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

		$('.location #province').change(function(){	//更换省份
			var pro_id = $('.location #province').val();
			changeArea('province',pro_id, 'location');
		});

		$('.location #city').change(function(){
			var city_id = $('.location #city').val();
			changeArea('city', city_id, 'location');
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

		//end 级联地址

	function leap_page(page){
		var from = $('#from').val();
		var to = $('#to').val();

		var url;
		url = '/vehicles?';
		url = url + 'vehicle_type=' + vehicle_type;
		url = url + '&vehicle_body_type=' + vehicle_body_type;
		url = url + '&vehicle_length=' + vehicle_length;
		url = url + '&vehicle_weight=' + vehicle_weight;
		url = url + '&from=' + from;
		url = url + '&to=' + to;
		url = url + '&page=' + page;
		window.location.href = url;
	};

});

var Vehicle = {
	add : function(id){
		var url = '/publish/vehicle';
		if(id){
			url = '/user/vehicle/edit/'+id;
		}
		var formData = {};
		var fields = [
				// 'from_area_id',
				// 'to_area_id',
				'driver_name',
				'phone',
				'plate_number',
				'vehicle_length',
				'vehicle_weight',
				// 'location_id',
				'info',
			];
		for(var x in fields){
			formData[fields[x]] = document.getElementById(fields[x]).value;
		}

		formData['from_area_id'] = $('.from #area').val();
		formData['to_area_id'] = $('.to #area').val();
		formData['vehicle_type'] = $('#vehicle_type').val();
		formData['vehicle_body_type'] = $('#vehicle_body_type').val();
		formData['location_id'] = $('.location #area').val();
		if(formData['from_area_id'] == '000'){
			alert('请选择发货地址');
			return false;
		}
		if(formData['to_area_id'] == '000'){
			alert('请选择目的地址');
			return false;
		}
		console.log(formData);
		$.ajax({
			url : url,
			type : 'POST',
			dataType : 'json',
			data : formData,
			success : function(rp){
				if(rp.code > 0){
					alert(rp.message);
					// window.location.href = '';
				}else{
					alert(rp.message);
				}
			}
		});
	},
	edit : function(id){
		Vehicle.add(id);
	},
	generateOrder : function(id){
		window.location.href = '/vehicle/order/'+id;
	},
	addOrder : function(vehicleId, vehicleUserId){
		$.ajax({
			url 	: '/vehicle/order/'+vehicleId,
			type 	: 'POST',
			dataType: 'json',
			data 	:  {vehicleUserId : vehicleUserId},
			success : function(rp){
				if(rp.code>0){
					alert(rp.message);
					window.location.href = "/user/order/list";
				}
			}
		})
	}
}

	
