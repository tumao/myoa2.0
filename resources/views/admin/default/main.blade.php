@include('default._shared.header')

@section('topMenubar')

	@include('default._shared.topMenubar')

@show

<div class="ch-container">
    <div class="row">
        @section('sidebar')
        	@include('default._shared.sidebar')
		@show

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
           		 <!-- navbar start -->
               @include('default._shared.navbar')
				<!-- navbar end -->
			    <div class="row">
			        <div class="box col-md-12">
						@yield('content')
			        </div>
			        <!--/span-->
			    </div><!--/row-->

	    <!-- content ends -->
	    </div><!--/#content.col-md-0-->
	</div><!--/fluid-row-->
    <hr>
    <!-- footer start -->
    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://usman.it" target="_blank">software backend</a> 2012 - 2014</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://wp.rchangchu.com">renchangchun</a></p>
    </footer>
    <!-- footer end -->

</div><!--/.fluid-container-->
@include('default._shared.footer')