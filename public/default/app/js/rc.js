var Picture = {
	form : function(){
		var form_title = '添加图片';
		var url = '/admin/rc/add';
		art.dialog.open(url,{
			title 	: form_title,
			ok 	: function(){
				window.location.href= '/admin/rc/lists';
			},
			// ok 		: false,
			cancle 	: false,
			lock 	: true,
			width 	: 400,
			height	: 200,
			resize 	: false,
			drag 	: true,
		});
	},
	del : function(id){
		$.ajax({
			url : '/admin/rc/delete/'+id,
			type : 'GET',
			dataType : 'json',
			success : function(rp){
				if(rp.code>0){
					window.location.href = '/admin/rc/lists'; // 刷新页面
				}
			}
		});
	}
}