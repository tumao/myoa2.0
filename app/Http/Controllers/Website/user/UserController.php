<?php namespace App\Http\Controllers\Website\User;

use App\Http\Controllers\Website\BaseController;
use App\Http\Controllers\Controller;

// 车源
class UserController extends BaseController
{

	public function __construct()
	{
		parent::__construct();

	}

	public function lists()
	{
		$vehicles = \DB::table('vehicle')->get();
		return view('website::resources.vehicles.lists')->with('lists',$vehicles);
	}

	public function self()
	{
		return view('website::user.user.self');
	}

	public function secret()
	{
		return view('website::user.user.secret');
	}

	public function vehicle()
	{
		$vehicle = \DB::select('SELECT * FROM `vehicle` ORDER BY id DESC');
		return view('website::user.user.vehicle')->with('vehicle', $vehicle);
	}

	public function merchandise()
	{
		$merchandise = \DB::select('SELECT * FROM `merchandise` ORDER BY id DESC');
		return view('website::user.user.merchandise')->with('merchandise', $merchandise);
	}

	// 用户注册
	public function register()
	{
		$this->sendMail('384331197@qq.com', '用户激活', "激活链接");
		$method = \Request::method();
		if($method == 'POST')
		{
			$email = \Request::input('email');
			$password = \Request::input('password');
			$phone = \Request::input('phone');
			try
			{
			    // Let's register a user.
			    $user = \Sentry::register(array(
			        'email'    	=> $email,
			        'password' 	=> $password,
			        'phone'		=> $phone,
			    ));

			    // Let's get the activation code
			    $activationCode = $user->getActivationCode();
			    

			    // Send activation code to the user so he can activate the account
			}
			catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
			    return array('code'=> -1, 'message'=> '邮箱必须填写');
			}
			catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
			    // echo 'Password field is required.';
			    return array('code' => -1, 'message'=> '密码栏必须填写');
			}
			catch (\Cartalyst\Sentry\Users\UserExistsException $e)
			{
			    // echo 'User with this login already exists.';
			    return array('code' => -2, 'message' => '用户名已经存在');
			}
		}
		return view('website::user.user.register');
	}

	// 新用户激活
	public function active($active_code)
	{
		$active_code = base64_decode($active_code);
		$active = explode('_user_', $active_code);
		list($code, $uid) = $active;
		try
		{
		    // Find the user using the user id
		    $user = Sentry::findUserById($uid);

		    // Attempt to activate the user
		    if ($user->attemptActivation($code))
		    {
		        // User activation passed
		    }
		    else
		    {
		        // User activation failed
		    }
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    // echo 'User was not found.';
		    return array('code' => '-1', 'message' => '未找到用户');
		}
		catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
		{
		    // echo 'User is already activated.';
		    return array('code'=> -2, 'message' => '用户已经被激活');
		}
	}
}