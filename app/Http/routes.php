<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::to('admin');
});

Route::get('admin', 'Admin\User\UserController@show');	//登录页
Route::get('admin/login', 'Admin\User\UserController@show');
Route::post('admin/auth', 'Admin\User\UserController@auth');	//用户认证

#user
Route::get('admin/logout', 'Admin\User\UserController@logout');	//登出

Route::get('admin/user', 'Admin\User\UserController@index');
Route::post('admin/user/create_user', 'Admin\User\UserController@createUser');

Route::get('admin/user/userconf', 'Admin\User\UserController@userList');	//用户列表
Route::get('admin/user/user_form/{id?}', 'Admin\User\UserController@userForm');		//添加用户的对话框
Route::post('admin/user/update_user', 'Admin\User\UserController@updateUser');	//更新用户信息
Route::get('admin/user/del_user/{id}', 'Admin\User\UserController@delUser');
Route::get('admin/user/self', 'Admin\User\UserController@userSelf');
Route::post('admin/user/pass_reset', 'Admin\User\UserController@passReset');

Route::get('admin/user/roles', 'Admin\User\RoleController@roles');	//分组列表
Route::get('admin/user/group_form/{id?}', 'Admin\User\RoleController@groupForm'); 	//添加(修改)用户组 对话框
Route::get('admin/user/create_group', 'Admin\User\RoleController@createGroup');	//创建分组
Route::get('admin/user/update_group/{id}', 'Admin\User\RoleController@updateGroup');	//更新组
Route::get('admin/user/del_group/{id}', 'Admin\User\RoleController@delGroup'); 	//删除组

Route::get('admin/user/permissions', 'Admin\User\PermissionsController@permissions');	//权限列表
Route::get('admin/user/save_permissions', 'Admin\User\PermissionsController@savePermissons');
Route::get('admin/user/edit_permissions/{id}', 'Admin\User\PermissionsController@editPermissions');
Route::get('admin/user/del_permission/{id}', 'Admin\User\PermissionsController@delPermission');

#index 仪表盘
Route::get('admin/dashboard', 'Admin\Index\DashboardController@index');
Route::get('admin/dashboard/index', 'Admin\Index\DashboardController@index');
Route::get('admin/dashboard/sys', 'Admin\Index\SysController@index');
Route::get('admin/dashboard/dashboard', 'Admin\Index\DashboardController@index');
Route::get('admin/dashboard/census', 'Admin\Index\CensusController@index');

#rc 资源
Route::get('admin/rc', 'Admin\Resource\RcController@index');


#conf
Route::get('admin/conf', 'Admin\Menu\MenuController@index');
Route::get('admin/conf/menu', 'Admin\Menu\MenuController@show');	//显示菜单列表
Route::get('admin/conf/add_menu_form/{id?}', 'Admin\Menu\MenuController@addMenuForm' );
Route::get('admin/conf/save_menu_form', 'Admin\Menu\MenuController@saveMenuForm');
Route::get('admin/conf/del_menu_item/{id}', 'Admin\Menu\MenuController@delMenuItem');
Route::get('admin/conf/edit_menu/', 'Admin\Menu\MenuController@editMenuItem');

