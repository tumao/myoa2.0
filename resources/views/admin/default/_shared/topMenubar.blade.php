<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html"> <!-- <img alt="Charisma Logo" src="/default/framework/img/logo20.png" class="hidden-xs"/> -->
            <span>后台管理</span></a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> 管理员</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="/admin/user/self">个人详情</a></li>
                <li class="divider"></li>
                <li><a href="/admin/logout">退出</a></li>
            </ul>
        </div>
        <!-- user dropdown ends -->
        <ul class="collapse navbar-collapse nav navbar-nav top-menu">
        @foreach( $menu['main_menu'] as $item)
            <li @if($item['active']) class="active" @endif> <a href="{{$item['path']}}"><i class="{{$item['icon']}}"></i>{{$item['name']}}</a></li>
        @endforeach
        </ul>
       <!--  <form class="navbar-form navbar-right" role="search">
        	<div class="form-group">
        		<input type="text" class="form-control" placeholder="请输入关键字" />
        	</div>
        	<button type="subbmit" class="btn btn-default" >搜索</button>
        </form> -->
    </div>
</div>
<!-- topbar ends -->