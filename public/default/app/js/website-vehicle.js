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
		var sum_page = $('#')
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
	add : function(){
		var formData = {};
		var fields = [
				// 'from_area_id',
				// 'to_area_id',
				'driver_name',
				'phone',
				'plate_number',
				'vehicle_length',
				'vehicle_weight',
				'location_id',
				'info',
			];
		for(var x in fields){
			formData[fields[x]] = document.getElementById(fields[x]).value;
		}

		formData['from_area_id'] = $('.from #area').val();
		formData['to_area_id'] = $('.to #area').val();
		formData['vehicle_type'] = $('#vehicle_type').val();
		formData['vehicle_body_type'] = $('#vehicle_body_type').val();
		if(formData['from_area_id'] == '000'){
			alert('请选择发货地址');
			return false;
		}
		if(formData['to_area_id'] == '000'){
			alert('请选择目的地址');
			return false;
		}

		$.ajax({
			url : '/publish/vehicle',
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
	}
}
