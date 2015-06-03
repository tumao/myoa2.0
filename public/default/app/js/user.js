var User = {
	form:function(id){
		var form_title = '添加用户';
		var url = '/admin/user/user_form';
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
					'first_name'
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
			// height:default_h,
			resize:false,
			drag:false
		});
	},
	edit:function(id){
		User.form(id);
	},
	del:function(id){
		art.dialog({
			lock	: true,
			content : '删除后无法恢复',
			icon	: 'error',
			ok 		: function(){
				$.ajax({
					type 	: 'GET',
					url 	: '/admin/user/del_user/'+id,
					dataType: 'json',
					success : function(rp){
						if( rp.code > 0){
							$('#row_'+id).remove();
							art.dialog.tips(rp.info, 1.5);
						}else{
							art.dialog.tips(rp.info, 1.5);
						}
						return true;
					}
				});
			},
			cancel 	: true,
		});
		
	},
	update_passwd:function(id,name){
		art.dialog({
			title 	: '密码重置',
			content : '新密码： <input id="newPasswd" type="text">' ,
			ok		: function(){
				var newPasswd = document.getElementById('newPasswd').value;
				$.ajax({
					type 	: 'POST',
					url 	: '/admin/user/pass_reset',
					dataType: 'json',
					data 	: {id:id,password:newPasswd},
					success : function(rp){
						if(rp.code >0) {
							art.dialog.tips(rp.message, 1.5);
							return true;
						}
					}
				});
			},
			cancel 	: true,
			resize 	: false,
			lock	: true,
		});
	}
}
/*输入验证*/
var Check = {
	user_form:function(input,form,id){		//验证 创建用户
		// if( input.username == ''){
		// 	art.dialog.tips('用户名不可为空！',2);
		// 	form['username'].focus();
		// 	return false;
		// }
		if( input.email == ''){
			art.dialog.tips('邮箱不可为空！',2);
			form['email'].focus();
			return false;
		}
		if( !(id > 0)){		//修改页面无密码
			if( input.password == ''){
				art.dialog.tips('密码不可为空',2);
				form['password'].focus();
				return false;
			}
		}
		return true;
	}
}