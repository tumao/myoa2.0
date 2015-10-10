var Picture = {
	form : function(){
		var form_title = '添加图片';
		var url = '/admin/rc/add';
		art.dialog.open(url,{
			title 	: form_title,
			// ok 	: function(){
			// 	// var iframe = this.iframe.contentWindow;
			// 	// var form = iframe.document.getElementById('pic-form');
			// 	// alert(form);
			// 	// form.submit();
			// },
			ok 		: false,
			cancle 	: false,
			lock 	: true,
			width 	: 400,
			height	: 400,
			resize 	: false,
			drag 	: true,
		});
	},
}