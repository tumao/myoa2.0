<style type="text/css">
body {
    font: 13px Arial, Helvetica, Sans-serif;
}

.haha {
    color: #FFFFFF;
}

#queue {
    background-color: #FFF;
    border-radius: 3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    height: 103px;
    margin-bottom: 10px;
    overflow: auto;
    padding: 5px 10px;
    width: 300px;
}
</style>
<link href='/default/framework/css/uploadify.css' rel='stylesheet'>

<form>
	<div id='queue'></div>
	<input id="file_upload" name="file_upload" type="file" multiple="true">
</form>
<div id='progress'></div>

<script type="text/javascript">
    $(function() {
        $('#file_upload').uploadify({
                            'debug'             : true,
                            'auto'              : true, //是否自动上传,
                            'buttonClass'       : 'haha', //按钮辅助class
                            'buttonText'        : '上传图片', //按钮文字
                            'height'            : 30, //按钮高度
                            'width'             : 100, //按钮宽度
                            'checkExisting'     : 'check-exists.php',//是否检测图片存在,不检测:false
                            'fileObjName'       : 'files', //默认 Filedata, $_FILES控件名称
                            'fileSizeLimit'     : '1024KB', //文件大小限制 0为无限制 默认KB
                            'fileTypeDesc'      : 'All Files', //图片选择描述
                            'fileTypeExts'      : '*.gif; *.jpg; *.png',//文件后缀限制 默认：'*.*'
                            'formData'          : {
                                'someKey' : 'someValue',
                                'someOtherKey' : 1
                            },//传输数据JSON格式
                            'queueID'           : 'queue', //默认队列ID
                            'queueSizeLimit'    : 20, //一个队列上传文件数限制
                            'removeCompleted'   : true, //完成时是否清除队列 默认true
                            'removeTimeout'     : 3, //完成时清除队列显示秒数,默认3秒
                            'requeueErrors'     : false, //队列上传出错，是否继续回滚队列
                            'successTimeout'    : 5, //上传超时
                            'uploadLimit'       : 99, //允许上传的最多张数
                            'swf'               : '/default/framework/uploadify.swf', //swfUpload
                            'uploader'          : '/admin/rc/add', //服务器端脚本
                        });
        });
</script>
