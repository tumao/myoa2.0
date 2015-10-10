<link rel="stylesheet" type="text/css" href="/app/css/menu.css">
<form id="menu-form" class='menu-form' name='menu-form' action="#" method="post" target="_top">
	<p><span>&nbsp;</span><label>菜 单 名 ： <input id="menu-form-name" name="name" type="text" value='{{$menu['name']}}'></label></p>
	<p><span>&nbsp;</span><label>图&nbsp;&nbsp;标 ： <input id="menu-form-icon" name="icon" type="text" value='{{$menu['icon']}}'></label></p>
	<!-- <p><span>&nbsp;</span><label>父&nbsp;&nbsp;ID ： <input id="menu-form-root" name="root" type="text" value=''></label></p> -->
	<p><span>&nbsp;</span><label>排&nbsp;&nbsp;序 ： <input id="menu-form-sort" name="sort" type="text" value='{{$menu['sort']}}'></label></p>
	<p><span>&nbsp;</span><label>路&nbsp;&nbsp;径 ： <input id="menu-form-path" name="path" type="text" value='{{$menu['path']}}'></label></p>
</form>