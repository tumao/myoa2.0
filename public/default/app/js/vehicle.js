var Vehicle = {
	form : function(id){
		var form_title = '添加';
		var url = '/admin/rc/user_form';
		var ajax_url = '/admin/user/create_user';
		if( id > 0){
			form_title = '修改用户';
			url = url + '/'+id;
			ajax_url = '/admin/user/update_user';
		}
		art.dialog.open(url,{
			title:form_title,
			ok:function(){
				var iframe = this.iframe.contentWindow;
				if(!iframe.document.body){
					$.dialog({content:'form 未加载完成'});
					return false;
				}
				var form = iframe.document.getElementById('user-form');

				var formData = {};
				var fields = [
					'username',
					'email',
					// 'first_name'
				];
				for( var x in fields){
					formData[fields[x]] = $.trim(form[fields[x]].value);
				}
				if(id > 0){
					formData['id'] = id;
				}else{
					formData['password'] = $.trim(form['password'].value);
				}

				var g = iframe.document.getElementsByName('user-group');
				$(g).each(function(){
					if( this.checked == true){
						formData['groupName'] = this.value;
					}
				});
				if( Check.user_form(formData,form,id)){
					$.ajax({
						type	: 'POST',
						url		: ajax_url,
						dataType: 'json',
						data 	: formData,
						success : function(rp){
							art.dialog.tips(rp.info, 1.5);
							location.reload();
						}
					});
					return true;
				}
				return false;
			},
			cancel:true,
			lock:true,
			width:380,
			resize:false,
			drag:false
		});

	},
}