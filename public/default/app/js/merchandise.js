var Merchandise = {
	form : function(id){
		var form_title = '添加';
		var url = '/admin/merchandise/add';
		var ajax_url = '/admin/merchandise/add';
		if( id > 0){
			form_title = '修改用户';
			url = '/admin/merchandise/edit';
			url = url + '/'+id;
			ajax_url = '/admin/merchandise/edit';
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
				var form = iframe.document.getElementById('mer-form');

				var formData = {};
				var fields = [
					'from_area_id',
					'to_area_id',
					'contact_name',
					// 'merchandise_date',
					'phone',
					'merchandise_name',
					'merchandise_weight',
					'merchandise_volume',
					'info',
					'user_id'
				];
				for( var x in fields){
					formData[fields[x]] = $.trim(form[fields[x]].value);
				}

				var merchandise_type = iframe.document.getElementById('merchandise_type').value;
				var merchandise_shipping_method = iframe.document.getElementById('merchandise_shipping_method').value;
				var merchandise_status = iframe.document.getElementById('merchandise_status').value;

				formData['merchandise_type'] = merchandise_type;
				formData['merchandise_shipping_method'] = merchandise_shipping_method;
				formData['merchandise_status'] = merchandise_status;

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
		Merchandise.form(id);
	},
	delete: function(id){
		art.dialog({
			lock	: true,
			content : '删除后无法恢复',
			icon	: 'error',
			ok 		: function(){
				$.ajax({
					type 	: 'GET',
					url 	: '/admin/merchandise/delete/'+id,
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