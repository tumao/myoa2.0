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

Route::get('/','Website\Home\IndexController@index');

Route::get('admin', 'Admin\User\UserController@show');	//登录页
Route::get('admin/login', array('uses'=>'Admin\User\UserController@show', 'as'=>'login'));
Route::post('admin/auth', 'Admin\User\UserController@auth');	//用户认证

Route::group(['middleware'=> ['auth.sentry']],function(){
#user
Route::get('admin/logout', 'Admin\User\UserController@logout');	//登出
Route::get('admin/user', 'Admin\User\UserController@index');
Route::post('admin/user/create_user', 'Admin\User\UserController@createUser');	//添加新用户
Route::get('admin/user/userconf', 'Admin\User\UserController@userList');	//用户列表
Route::get('admin/user/user_form/{id?}', 'Admin\User\UserController@userForm');		//添加用户的对话框
Route::post('admin/user/update_user', 'Admin\User\UserController@updateUser');	//更新用户信息
Route::get('admin/user/del_user/{id}', 'Admin\User\UserController@delUser');
Route::get('admin/user/self', 'Admin\User\UserController@userSelf');
Route::post('admin/user/pass_reset', 'Admin\User\UserController@passReset');

Route::get('admin/user/groups', 'Admin\User\GroupController@groups');	//分组列表
Route::get('admin/user/group_form/{id?}', 'Admin\User\GroupController@groupForm'); 	//添加(修改)用户组 对话框
Route::get('admin/user/create_group', 'Admin\User\GroupController@createGroup');	//创建分组
Route::get('admin/user/update_group/{id}', 'Admin\User\GroupController@updateGroup');	//更新组
Route::get('admin/user/del_group/{id}', 'Admin\User\GroupController@delGroup'); 	//删除组

Route::get('admin/user/permissions', 'Admin\User\PermissionsController@permissions');	//权限列表
Route::get('admin/user/save_permissions', 'Admin\User\PermissionsController@savePermissions');
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
Route::get('admin/rc/merchandise', 'Admin\Resource\MerchandiseController@lists');	//货源
Route::match(['get','post'],'admin/merchandise/add', 'Admin\Resource\MerchandiseController@add');
Route::match(['get','post'],'admin/merchandise/edit/{id}', 'Admin\Resource\MerchandiseController@edit');
Route::get('admin/merchandise/delete/{id}', 'Admin\Resource\MerchandiseController@delete');

Route::get('admin/rc/vehicle', 'Admin\Resource\VehicleController@lists');	//车源
Route::match(['get', 'post'], 'admin/vehicle/add', 'Admin\Resource\VehicleController@add');
Route::match(['get', 'post'], 'admin/vehicle/edit/{id}', 'Admin\Resource\VehicleController@edit');
Route::get('admin/vehicle/delete/{id}', 'Admin\Resource\VehicleController@delete');

Route::get('admin/rc/lists', 'Admin\Resource\RcController@lists');
Route::match(['get','post'],'admin/rc/add', 'Admin\Resource\RcController@add');

#conf
Route::get('admin/conf', 'Admin\Menu\MenuController@index');
Route::get('admin/conf/menu', 'Admin\Menu\MenuController@show');	//显示菜单列表
Route::get('admin/conf/add_menu_form/{id?}', 'Admin\Menu\MenuController@addMenuForm' );
Route::get('admin/conf/save_menu_form', 'Admin\Menu\MenuController@saveMenuForm');
Route::get('admin/conf/del_menu_item/{id}', 'Admin\Menu\MenuController@delMenuItem');
Route::get('admin/conf/edit_menu/', 'Admin\Menu\MenuController@editMenuItem');

});

Route::get('captcha/{tmp}', 'CaptchaController@captcha');
Route::post('get_areas', "Website\Resources\VehiclesController@getAreas");
Route::match(['get','post'], 'user/register', "Website\User\UserController@register");

Route::get('vehicles', 'Website\Resources\VehiclesController@lists');	//搜索车源,车源列表
Route::get('merchandise', 'Website\Resources\MerchandiseController@lists'); //搜索货源，货源列表

Route::match(['get','post'], 'publish/merchandise', 'Website\Resources\MerchandiseController@add');	// 发布信息--货源
Route::match(['get','post'], 'publish/vehicle', 'Website\Resources\VehiclesController@add');		//发布信息--车源
Route::match(['get','post'], 'publish/vehicle/edit', 'Website\Resources\VehiclesController@edit');	//修改信息--车源


Route::match(['get', 'post'], 'user/self', 'Website\User\UserController@self');
Route::match(['get', 'post'], 'user/secret', 'Website\User\UserController@secret');
Route::match(['get', 'post'], 'user/vehicle', 'Website\User\UserController@vehicle');
Route::match(['get', 'post'], 'user/merchandise', 'Website\User\UserController@merchandise');