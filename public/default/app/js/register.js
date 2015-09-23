var Register = {
	add : function(){
		var data = {};
		var fields = [
			'email',
			'nickname',
			'password',
			'phone'
		];
		for(var x in fields){
			data[fields[x]] = document.getElementById(fields[x]).value;
		}
		var sure_password = document.getElementById('password_make_sure').value;
		if(data['password'] != sure_password){
			alert('两次密码输入不一致，请重新输入');
			$('#password').focus();
		}
		if(data['email'] == ''){
			alert('邮箱不可为空');
		}
		if(data['nickname'] == ''){
			alert('昵称不可为空');
			return false;
		}
		if(data['password'] == ''){
			alert('密码不可为空');
			return false;
		}
		$.ajax({
			url 	: '/user/register',
			type 	: 'POST',
			dataType : 'json',
			data 	: data,
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

var User = {
	load : function(){
		var data = {};
		var fields = [
			'email',
			'password'
		];
		var remember = $('#remember').prop('checked');
		data['remember'] = remember;

		for(var x in fields){
			data[fields[x]] = document.getElementById(fields[x]).value;
		}
		if(data['email'] == ''){
			alert('登录邮箱不可为空！');
			$('#email').focus();
		}
		if(data['password'] == ''){
			alert('密码不可为空');
			$('#password').focus();
		}
		$.ajax({
			url : '/user/load',
			type : 'POST',
			dataType : 'json',
			data : data,
			success : function(rp){
				if(rp.code > 0){
					alert(rp.message);
					// window.location.href = ''；
				}else{
					alert(rp.message);
				}
			}
		});
	}
}