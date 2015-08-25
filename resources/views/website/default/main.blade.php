<!DOCTYPE html>
<html lang="zh-CN">
@include('website::_shared.header')
<body>
<!-- nav -->
@section('topMenu')
	@include('website::_shared.menu')
@show
<!-- nav end-->
	<!-- content -->
		@yield('content')
	<!-- content end -->
@include('website::_shared.footer')

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/default/framework/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- add++++ -->
	<script src="/default/app/js/shipping-home.js"></script>
</body>
</html>