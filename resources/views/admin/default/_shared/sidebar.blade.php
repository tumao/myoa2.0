<!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">仪表盘</li>
                        @foreach($menu['sub_menu'] as $item)
                        <li @if($item['active']) class="active" @endif>
                            <a href="{{$item['path']}}"><i class="{{$item['icon']}}"></i><span>{{$item['name']}}</span></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->