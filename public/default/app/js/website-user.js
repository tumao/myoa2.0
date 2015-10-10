var User = {
	save : function(){
		var data = {};
		var fields = [
			'username',
			'phone',
			'email'
		];
		for(var x in fields){
			data[fields[x]] = document.getElementById(fields[x]).value;
		}
		$.ajax({
			url : '/user/self',
			type : 'POST',
			data : data,
			dataType : 'json',
			success : function(rp){
				alert(rp.message);
				if(rp.code > 0){

				}else
				{

				}
			}
		});
	},
	secret : function(){
		var data = {};
		data['old_password'] = document.getElementById('old_password').value;	// 旧密码
		data['password'] = document.getElementById('password').value;			// 新密码
		var new_password = document.getElementById('new_password').value;		// 新密码的确认
		if(new_password != data['password']){
			alert('新密码和确认密码不一致！');
			return false;
		}
		$.ajax({
			url 	: '/user/secret',
			type 	: 'POST',
			dataType : 'json',
			data 	: data,
			success : function(rp){
				alert(rp.message);
				if(rp.code > 0){	// 旧密码啊正确，页面跳转
					window.location.href = rp.url;
				}else{				// 旧密码不正确，保持原有页面
					$("#old_password").empty();
					$("#password").empty();
					$('#new_password').empty();
				}
			}

		});
	}
};