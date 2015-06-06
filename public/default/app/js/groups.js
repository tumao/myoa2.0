var Group = {
	form : function(id){
		var form_title = '添加用户组';
		var url = '/admin/user/group_form';
		var ajaxUrl = '/admin/user/create_group';
		if( id){
			url += '/'+id;
			ajaxUrl = '/admin/user/update_group/'+id;
		}
		art.dialog.open(url,{
			title 	: form_title,
			ok 		: function(){
				var formData = {};
				var permissions = new Array();;
				var iframe = this.iframe.contentWindow;
				if(!iframe.document.body)		//iframe 加载失败
				{
					$.dialog({content: 'form 未加载完成'});
					return false;
				}
				var form = iframe.document.getElementById('role-form');
				formData['name'] = $.trim(form['rolename'].value);
				formData['display_name'] = $.trim(form['role_display_name'].value);
				var g = iframe.document.getElementsByName('permission-group');
				$(g).each(function(){
					if(this.checked == true){
						permissions.push(this.value);
					}/*else{
						permissions[this.value] = 0
					}*/
				});
				formData['permissions'] = permissions;
				$.ajax({
					url 	: ajaxUrl,
					type 	:　'GET',
					dataType: 'json',
					data 	: formData,
					success : function(rp){
						art.dialog.tips(rp.message, 1.5);
						if(rp.code > 0){
							location.reload();
						}
					}
				});
				return true;
			},
			width	: 350,
			cancel 	: true,
			lock 	: true,
			resize 	: false,
			drag 	: false
		});
	},
	edit 	: function(id){

	},
	del 	: function(id){
		art.dialog({
			lock 	:true,
			content : '删除后无法恢复',
			ok 		: function(){
				$.ajax({
					url 	: '/admin/user/del_group/'+id,
					type 	:　'GET',
					dataType: 'json',
					success : function(rp){
						if(rp.code > 0){
							$('#row_'+id).remove();
						}
						art.dialog.tips(rp.message, 1.5);
					}
				});
			},
			cancel : true,
		})
	},
}