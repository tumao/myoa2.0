var Permissions = {
	form : function(permission){
		var form_title = '添加权限';
		var ajaxUrl = '/admin/user/save_permissions';
		if(permission){
			form_title = '修改权限';
			ajaxUrl = '/admin/user/edit_permissions';
			ajaxUrl += '/'+permission.id;
			html_content = '权限编码:&nbsp;<input id="pname" type="text" value="'+permission.name+'"><br/>';
			html_content += '权限名称:&nbsp;<input id="display_name" type="text" value="'+permission.display_name+'" style="margin-top:10px;"><br/>';
			html_content += '权限描述:&nbsp;<input id="description" type="text" value="'+permission.description+'" style="margin-top:10px;">';
		}else{
			html_content = '权限编码:&nbsp;<input id="pname" type="text" value=""><br/>';
			html_content += '权限名称:&nbsp;<input id="display_name" type="text" value="" style="margin-top:10px;"><br/>';
			html_content += '权限描述:&nbsp;<input id="description" type="text" value="" style="margin-top:10px;">';
		}

		art.dialog({
			title   : form_title,
			content : html_content,
			ok 		: function(){
				var pname = document.getElementById('pname').value;
				var display_name = document.getElementById('display_name').value;
				var description = document.getElementById('description').value;
				if(pname == ''){
					art.dialog.tips('权限编码!', 1.5);
					return false;
				}
				if( display_name == ''){
					art.dialog.tips('权限名称不可为空!', 1.5);
					return false;
				}
				if( description == '')
				{
					art.dialog.tips('描述不可为空')
				}
				$.ajax({
					type : 'GET',
					url  : ajaxUrl,
					dataType : 'json',
					data : {name:pname,display_name:display_name,description:description},
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