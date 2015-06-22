// admin/user 页面
function userlogin()
{
	var username = $.trim($('#username').val());
	var password = $.trim($('#password').val());
	var captcha = $.trim($('#captcha').val());
	var remember = $('#remember').prop('checked');
	if( username == '')
	{
		$('#username').trigger('focus');
		return false;
	}
	else if( password == '')
	{
		$('#password').trigger('focus');
		return false;
	}
	else if( captcha == '')
	{
		$('#captcha').trigger('focus');
		return false;
	}
	$.ajax({
		'url'	:'/admin/auth',
		'type'	:'post',
		'dataType'	: 'json',
		'data'	:{
			username:username,
			password:password,
			captcha : captcha,
			remember:remember
		},
		'success':function(rp)
		{
			if(rp.code > 0)
			{
				alert(rp.message);
				window.location.href= rp.redirect_url;
			}
			else
			{
				alert(rp.message);
				updateCaptcha();
				return false;
			}
		}
	})
}

function updateCaptcha(){
	var timestamp = (new Date()).valueOf();
	var content = '<img id="captchaImg" src="/captcha/'+timestamp+'">';
	$("#captchaImg").replaceWith(content);
}
