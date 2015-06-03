<?php namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use App\Http\Controllers\Admin\ABaseController;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends ABaseController {

	//
	public function index()
	{

	}

	public function show()
	{
		// if(\Sentry::check())
		// {
		// 	// header('location:/');
		// 	return \Redirect::to('/admin/dashboard');
		// }
		/*$this->layout->content = */
		return \View::make("default.user.login");
	}

	public function auth()
	{
		$request = \Request::only('username', 'password', 'remember');
		if(\Auth::attempt(array('email' => $request['username'], 'password'=> $request['password'])))
		{
			echo 'login success';
		}
		else
		{
			echo 'something wrong';
		}

	}

	/**
	 * 用户注册/管理员创建用户
	 *
	 * @return Response
	 */
	public function createUser()
	{
		if(\Request::isMethod('post'))
		{
			$user = \Input::all();
		}
		var_dump( $user);
		try
		{
		    // Create the user
		    $user_info = \Sentry::createUser(array(
		    	'real_name'	=> $user['real_name'],
		        'email'     => $user['email'],
		        'password'  => $user['password'],
		        'activated' => true,
		    ));

		    $group = \Sentry::findGroupByName($user['groupName']);	//通过组名查找组

		    $user_info->addGroup($group);			//把用户加入组中
		    return array('code' => 1, 'info' => '用户创建成功');
		}
		catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return array('code' => -1, 'info'=> '用户名不可为空');
		}
		catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    return array('code' => -2, 'info'=> '密码不可为空');
		}
		catch (\Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    return array('code' => -3, 'info'=> '用户名已经存在，请直接登录');
		}
		catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    return array('code' => -4, 'info'=> '未找到分组');
		}
	}

	public function logout()
	{

	}
}
