$(document).ready(function(){
	var vehicle_type = 0;	//货车类型
	var vehicle_body_type = 0;	// 货车车身类型
	var vehicle_length = 0;
	var vehicle_weight = 0;

	vehicle_type = $('.vehicle_type .check').attr('data-vehicle-type');
	vehicle_body_type = $('.vehicle_body_type .check').attr('data-vehicle-body-type');
	vehicle_length = $('.vehicle_length .check').attr('data-vehicle-length');
	vehicle_weight = $('.vehicle_weight .check').attr('data-vehicle-weight');

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
});