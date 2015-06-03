var Permissions = {
	form : function(permission){
		var form_title = '添加权限';
		var ajaxUrl = '/admin/user/save_permissions';
		if(permission){
			form_title = '修改权限';
			ajaxUrl = '/admin/user/edit_permissions';
			ajaxUrl += '/'+permission.id;
			html_content = '权限名称:&nbsp;<input id="permissionName" type="text" value="'+permission.name+'"><br/>';
			html_content += '权限编码:&nbsp;<input id="permissionCode" type="text" value="'+permission.code+'" style="margin-top:10px;">';
		}else{
			html_content = '权限名称:&nbsp;<input id="permissionName" type="text" value=""><br/>';
			html_content += '权限编码:&nbsp;<input id="permissionCode" type="text" value="" style="margin-top:10px;">';
		}
		
		art.dialog({
			title   : form_title,
			content : html_content,
			ok 		: function(){
				var permissionName = document.getElementById('permissionName').value;
				var permissionCode = document.getElementById('permissionCode').value;
				if(permissionName == ''){
					art.dialog.tips('权限名称不可为空!', 1.5);
					return false;
				}
				if( permissionCode == ''){
					art.dialog.tips('权限编码不可为空!', 1.5);
					return false;
				}
				$.ajax({
					type : 'GET',
					url  : ajaxUrl,
					dataType : 'json',
					data : {name:permissionName,code:permissionCode},
					success : function(rp){
						if(rp.code == 1){
							art.dialog.tips(rp.message, 1.5);
							location.reload();
						}
					}
				});
				return true;
			},
			cancel : true,
			resize : false,
			lock   : true,
		});
	},
	del : function(id, pname){
		art.dialog({
			title 	: '删除项目',
			content : '删除'+pname+'后将无法恢复!',
			ok : function(){
				$.ajax({
					type : 'GET',
					url  : '/admin/user/del_permission/'+id,
					dataType : 'json',
					success  : function(rp){
						if(rp.code > 0){
							$('#row_'+id).remove();
							art.dialog.tip(rp.message, 1.5);
						}
					}
				});
			},
			cancelVal : '关闭',
			cancel : true
		});
	},
}