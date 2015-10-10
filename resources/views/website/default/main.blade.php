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
</body>
</html>