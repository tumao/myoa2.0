<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="//cdn.bootcss.com/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="/default/framework/js/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/default/framework/css/uploadify.css">
<style type="text/css">
body {
    font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
    <h1>请上传图片，提交后自动上传</h1>
    <form>
        <div id="queue"></div>
        <input id="file_upload" name="file_upload" type="file" multiple="true">
    </form>

    <script type="text/javascript">
        $(function() {
            $('#file_upload').uploadify({
                'swf'      : '/default/framework/uploadify.swf',
                'uploader' : '/admin/rc/add',
                'buttonText' : '请上传图片',
                'fileTypeDesc' : 'image file',
                'fileTypeExts' : '*.gif;*.jpg;*.png',
            });
        });
    </script>
</body>
</html>