<?php namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use App\Http\Controllers\Admin\ABaseController;

use Illuminate\Http\Request;
use App\User;			//model
use Auth;
use App\Services\Registrar;

class UserController extends ABaseController {

	//
	public function index()
	{

	}

	public function show()
	{
		if(Auth::check())
		{
			return \Redirect::to('/admin/dashboard');
		}
		return \View::make("default.user.login");
	}

	public function auth()
	{
		$request = \Request::only('username', 'password', 'remember');
		if(Auth::attempt(array('email' => $request['username'], 'password'=> $request['password']), $request['remember']))
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
		// if(\Request::isMethod('post'))
		// {
		// 	$user = \Input::all();
		// }
		    // Create the user
		    // $user_info = \Sentry::createUser(array(
		    // 	'real_name'	=> $user['real_name'],
		    //     'email'     => $user['email'],
		    //     'password'  => $user['password'],
		    //     'activated' => true,
		    // ));
		$data = array(
			'name'	=> 'admins',
			'email'	=> 'admin@admin.comd',
			'password'	=> '12345'
			);
		$register = new Registrar;
		$vali = $register->validator($data);
		echo $vali->messages();exit;
		if($vali)
		{
			$result = $register->create($data);

			if($result)
			{
			    return array('code' => 1, 'info' => '用户创建成功');
			}
		}
		else
		{
			return array('code' => 0, 'info'=> '用户创建失败');
		}


	}

	public function logout()
	{
		if(Auth::check())
		{
			Auth::logout();
			return Redirect::to('/admin');
		}
	}
}
