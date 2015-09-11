var Vehicle = {
	form : function(id){
		var form_title = '添加';
		var url = '/admin/vehicle/add';
		var ajax_url = '/admin/vehicle/add';
		if( id > 0){
			form_title = '修改用户';
			var url = '/admin/vehicle/edit';
			url = url + '/'+id;
			ajax_url = '/admin/vehicle/edit';
			ajax_url = ajax_url + '/' + id;
		}
		art.dialog.open(url,{
			title:form_title,
			ok:function(){
				var iframe = this.iframe.contentWindow;
				if(!iframe.document.body){
					$.dialog({content:'form 未加载完成'});
					return false;
				}
				var form = iframe.document.getElementById('veh-form');

				var formData = {};
				var fields = [
					'from_area_id',
					'to_area_id',
					'driver_name',
					'phone',
					'plate_number',
					'vehicle_length',
					'vehicle_weight',
					'location_id',
					'info',
					'user_id'
				];
				for( var x in fields){
					formData[fields[x]] = $.trim(form[fields[x]].value);
				}

				var vehicle_type = iframe.document.getElementById('vehicle_type').value;
				var vehicle_body_type = iframe.document.getElementById('vehicle_body_type').value;
				formData['vehicle_type'] = vehicle_type;
				formData['vehicle_body_type'] = vehicle_body_type;

				$.ajax({
					type	: 'POST',
					url		: ajax_url,
					dataType: 'json',
					data 	: formData,
					success : function(rp){
						art.dialog.tips(rp.message, 1.5);
						location.reload();
					}
				});
				return true;
			},
			cancel:true,
			lock:true,
			width:380,
			resize:false,
			drag:false
		});

	},
	edit : function(id){
		alert(id);
		Vehicle.form(id);
	},
	delete: function(id){
			art.dialog({
			lock	: true,
			content : '删除后无法恢复',
			icon	: 'error',
			ok 		: function(){
				$.ajax({
					type 	: 'GET',
					url 	: '/admin/vehicle/delete/'+id,
					dataType: 'json',
					success : function(rp){
						if( rp.code > 0){
							$('#row_'+id).remove();
							art.dialog.tips(rp.message, 1.5);
						}else{
							art.dialog.tips(rp.message, 1.5);
						}
						return true;
					}
				});
			},
			cancel 	: true,
		});
	},
}
