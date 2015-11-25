$(document).ready(function(){
	var merchandise_type = 0;	//货车类型
	var merchandise_shipping_method = 0;	// 货车车身类型
	var page = 1;

	merchandise_type = $('.merchandise_type .check').attr('data-merchandise-type');
	merchandise_shipping_method = $('.merchandise_shipping_method .check').attr('data-merchandise-shipping-method');
	page= $('.checkedon').attr('data-page');

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
		url = '/merchandises?';
		url = url + 'merchandise_type=' + merchandise_type;
		url = url + '&merchandise_shipping_method=' + merchandise_shipping_method;
		url = url + '&from=' + from;
		url = url + '&to=' + to;
		window.location.href = url;
	});

	$(".sr_cell").click(function(){
		var id = $(this).attr('data-cell-id');
		window.location.href = '/merchandises/detail/'+id;
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
		url = '/merchandises?';
		url = url + 'merchandise_type=' + merchandise_type;
		url = url + '&merchandise_shipping_method=' + merchandise_shipping_method;
		url = url + '&from=' + from;
		url = url + '&to=' + to;
		url = url + '&page=' + page;
		window.location.href = url;
	}
});

var Merchandise = {
	add : function(id){
		var url = '/publish/merchandise';
		if(id){
			url = '/user/merchandise/edit/'+id;
		}
		var formData = {};
		var fields = [
				'from_area_id',
				'to_area_id',
				'contact_name',
				'merchandise_date',
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

		$.ajax({
			url 	: url,
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
	edit : function(id){
		Merchandise.add(id);
	},
	generateOrder : function(id){	//生成订单详情
		window.location.href = '/merchandises/order/'+id;
	},
	addOrder : function(mid,userId,driverId){	//货物id,货方id,运方id
		$.ajax({
			url 	: '/merchandises/order/'+mid,
			type 	:　'POST',
			data 	: {userId:userId, driverId:driverId},
			dataType: 'json',
			success : function(rp){
				if(rp.code > 0){
					alert(rp.message);
					window.location.href="/user/order/list";	//跳转到我的订单
				}
			}
		});
	},
}
