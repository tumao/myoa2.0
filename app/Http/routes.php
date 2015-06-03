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
