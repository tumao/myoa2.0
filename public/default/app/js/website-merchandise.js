$(document).ready(function(){
	var merchandise_type = 0;	//货车类型
	var merchandise_shipping_method = 0;	// 货车车身类型
	var page = 1;

	merchandise_type = $('.merchandise_type .check').attr('data-merchandise-type');
	merchandise_shipping_method = $('.merchandise_shipping_method .check').attr('data-merchandise-shipping-method');
	// page= $('.checkedon').attr('data-page');

	$('.merchandise_type li').click(function(){
		merchandise_type = $(this).attr('data-merchandise-type');
		$('.merchandise_type .check').removeClass('check');
		$(this).addClass('check');
	});
	$('.merchandise_shipping_method li').click(function(){
		merchandise_shipping_method = $(this).attr('data-merchandise-shipping-method');
		$('.merchandise_shipping_method .check').removeClass('check');
		$(this).addClass('check');
	});

	// $('.page .npage').click(function(){
	// 	page = $(this).attr('data-page');
	// 	leap_page(page);
	// });

	// $('.page .up_page').click(function(){
	// 	page = page -1;
	// 	if(page<1){
	// 		return false;
	// 	}
	// 	leap_page(page);
	// });
	// $('.page .down_page').click(function(){
	// 	var sum_page = $('#')
	// 	page = parseInt(page)+1;
	// 	leap_page(page);
	// });

	$('#search').click(function(){
		var from = $('#from').val();
		var to = $('#to').val();

		var url;
		url = '/merchandise?';
		url = url + 'merchandise_type=' + merchandise_type;
		url = url + '&merchandise_shipping_method=' + merchandise_shipping_method;
		url = url + '&from=' + from;
		url = url + '&to=' + to;
		window.location.href = url;
	});

	function leap_page(page){
		var from = $('#from').val();
		var to = $('#to').val();

		var url;
		url = '/merchandise?';
		url = url + 'vehicle_type=' + vehicle_type;
		url = url + '&vehicle_body_type=' + vehicle_body_type;
		url = url + '&vehicle_length=' + vehicle_length;
		url = url + '&vehicle_weight=' + vehicle_weight;
		url = url + '&from=' + from;
		url = url + '&to=' + to;
		url = url + '&page=' + page;
		window.location.href = url;
	}
});

var Merchandise = {
	add : function(){
		var formData = {};
		var fields = [
				// 'from_area_id',
				// 'to_area_id',
				'contact_name',
				// 'merchandise_date',
				'phone',
				'merchandise_name',
				'merchandise_weight',
				'merchandise_volume',
				'info',
			];
		for(var x in fields){
			formData[fields[x]] = document.getElementById(fields[x]).value;
		}
		formData['from_area_id'] = $('.from #area').val();
		formData['to_area_id'] = $('.to #area').val();
		formData['merchandise_type'] = $('#merchandise_type').val();
		formData['merchandise_shipping_method'] = $('#merchandise_shipping_method').val();
		if(formData['from_area_id'] == '000'){
			alert('请选择起始地址');
			return false;
		}
		if(formData['to_area_id'] == '000'){
			alert('请选择目的地');
			return false;
		}
		console.log(formData);
		$.ajax({
			url 	: '/publish/merchandise',
			type 	: 'POST',
			dataType : 'json',
			data 	: formData,
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
}
