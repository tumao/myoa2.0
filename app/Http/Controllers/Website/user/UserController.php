<?php namespace App\Http\Controllers\Website\User;

use App\Http\Controllers\Website\BaseController;
use App\Http\Controllers\Controller;
use App\User;

// 车源
class UserController extends BaseController
{
	private $page_limit = 10;

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

		if(\Session::has('currentUser'))
		{
			$user = \Session::get('currentUser');
			$user = User::find($user->id);
		}
		else
		{
			return \Redirect::to('/user/load');
		}
		$method = \Request::method();
		if($method == 'POST')
		{
			$input = \Request::only('username', 'phone','email');
			// \DB::update('update `users` set username =? ,phone =? WHERE email =?', [$input['username'],$input['phone'],$input['email']]);
			\DB::table('users')	->where('email',$input['email'])
								->update(['username'=>$input['username'],'phone'=>$input['phone']]);
			return array('code'=> 1, 'message' => '用户信息修改成功','url'=>'/');
		}
		return view('website::user.user.self')->with('user', $user);
	}

	public function secret()
	{
		$method = \Request::method();
		if($method == 'POST'){
			$input =  \Request::only('old_password','password');
			try
			{
			    $currentUser = \Sentry::getUser();		//获取当前登录的用户
			    try
				{
				    // Find the user using the user id
				    $user = \Sentry::findUserById($currentUser->id);

				    if($user->checkPassword($input['old_password']))	// 旧密码正确
				    {
				    	$user->password = $input['password'];
				    	if($user->save())
				    	{
				    		return array('code' => 1, 'message' => '新密码设置成功!', 'url' => '/user/self');
				    	}
				    }
				    else 		// 旧密码不正确
				    {
				    	return array('code' => -2, 'message' => '旧密码不正确，请重新输入!');
				    }
				}
				catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
				{
				    return array('code'=> -3, 'message' => '当前用户不存在，请重新登陆再试');
				}
			}
			catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    return array('code'=> -1, 'message' => '当前用户不存在，请重新登陆再试');
			}
		}
		return view('website::user.user.secret');
	}

	public function vehicle()
	{
		$page_limit = $this->page_limit; //每页显示数据的条数
		$data['vehicle'] = array();
		if(\Request::input('page'))
		{
			$page = \Request::input('page');
		}
		else
		{
			$page = 1;
		}

		$offset = ($page - 1) * $page_limit;

		$limit = "LIMIT $offset, $page_limit ";

		try
		{
		    $user = \Sentry::getUser();	//获取当前已经登陆的用户
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return array('code'=> -1, 'message' => '用户信息获取失败，请重新登陆！');
		}
		$sql = 'SELECT * FROM `vehicle` WHERE user_id =:id ORDER BY id DESC ';
		$vehicle = \DB::select($sql ,['id'=> $user->id]);
		$sum_page = ceil(count($vehicle)/$page_limit);
		$sql = $sql.$limit;
		$vehicle = \DB::select($sql, ['id' => $user->id]);

		foreach($vehicle as & $item)
		{
			$area = $this->getArea($item->from_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$item->from['area'] =  $area->area;
			$item->from['city'] = $city->city;
			$item->from['province'] = $province->province;

			$area = $this->getArea($item->to_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$item->to['area'] =  $area->area;
			$item->to['city'] = $city->city;
			$item->to['province'] = $province->province;
		}
		$checked['page'] = $page;
		$data['sum_page'] = $sum_page;
		$data['vehicle'] = $vehicle;
		$data['checked'] = $checked;
		return view('website::user.user.vehicle')->with('data', $data);
	}

	public function merchandise()
	{
		$page_limit = $this->page_limit;
		$data = array();
		try
		{
		    $user = \Sentry::getUser();	//获取当前已经登陆的用户
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return array('code'=> -1, 'message' => '用户信息获取失败，请重新登陆！');
		}
		if(\Request::input('page'))	// 获取页码
		{
			$page = \Request::input('page');
		}
		else 	// 默认的页码
		{
			$page = 1;
		}
		$sql = 'SELECT * FROM `merchandise` WHERE `user_id`=:user_id ORDER BY id DESC ';
		$merchandise = \DB::select($sql, ['user_id'=>$user->id]);
		$sum_page = ceil(count($merchandise) / $page_limit);
		$offset = ($page -1) * $page_limit;
		$limit = " LIMIT $offset, $page_limit";
		$sql = $sql.$limit;
		$merchandise = \DB::select($sql, ['user_id'=>$user->id]);
		foreach($merchandise as & $item)
		{
			$area = $this->getArea($item->from_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$item->from['area'] =  $area->area;
			$item->from['city'] = $city->city;
			$item->from['province'] = $province->province;

			$area = $this->getArea($item->to_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$item->to['area'] =  $area->area;
			$item->to['city'] = $city->city;
			$item->to['province'] = $province->province;			

		}
		$checked['page'] = $page;
		$data['sum_page'] = $sum_page;
		$data['merchandise'] = $merchandise;
		$data['checked'] = $checked;
		return view('website::user.user.merchandise')->with('data', $data);
	}

	// 用户注册
	public function register()
	{
		$this->sendMail('384331197@qq.com', '用户激活', "激活链接");
		$method = \Request::method();
		if($method == 'POST')
		{
			$input = array();
			$email = \Request::input('email');
			$password = \Request::input('password');
			$phone = \Request::input('phone');
			$username = \Request::input('nickname');

			$input['email'] = $email;
			$input['password'] = $password;
			if($phone)
			{
				$input['phone'] = $phone;
			}
			if($username)
			{
				$input['username'] = $username;
			}
			try
			{
			    // Let's register a user.
			    $user = \Sentry::register($input);
			    $group = \Sentry::findGroupByName('普通用户');
			    $user->addGroup($group);

			    // Let's get the activation code
			    $activationCode = $user->getActivationCode();
			    // Send activation code to the user so he can activate the account
			    return array('code' => 1, 'message'=> '注册成功!');
			}
			catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
			    return array('code'=> -1, 'message'=> '邮箱必须填写');
			}
			catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
			{
			    return array('code' => -1, 'message'=> '密码栏必须填写');
			}
			catch (\Cartalyst\Sentry\Users\UserExistsException $e)
			{
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
		    return array('code' => '-1', 'message' => '未找到用户');
		}
		catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
		{
		    return array('code'=> -2, 'message' => '用户已经被激活');
		}
	}

	// 用户登录
	public function load()
	{
		$method = \Request::method();

		// if(\Sentry::check())
		// {
		// 	if(\Session::has('last_uri'))
		// 	{
		// 		return \Redirect::to(\Session::get('last_uri'));
		// 	}
		// }
		if($method == 'POST')
		{
			$input = \Request::only('email','password','remember');
			try
			{
				$remember = $input['remember'] ? $input['remember'] : false;
				$auths = array(
					'email'	=> $input['email'],
					'password'	=> $input['password']
					);
				$result = \Sentry::authenticate( $auths, $remember);
				if($result)
				{	
					\Session::put('currentUser', $result);		//对象存入sesson
					if(\Session::has('last_uri'))
					{
						$redirect_url = \Session::get('last_uri');
						\Session::forget('last_uri');	//删除key对应的value
					}
					else
					{
						$redirect_url = '/';
					}
					return array('code'=>1, 'message'=>trans("user.LOGIN_SUCCESS"), 'redirect_url' => $redirect_url);
				}
			}
			catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
			    return array('code'=>-1, 'message'=>trans('user.LOGIN_FIELD_REQUIRED'));
			}
			catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    return array('code'=>-2, 'message'=> trans('user.USER_NOT_FOUND'));
			}
			catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
			    return array('code'=>-3, 'message'=>trans('user.USER_NOT_ACTIVATED'));
			}

			catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
			    $time = $throttle->getSuspensionTime();

			    return array('code'=>-4, 'message'=>trans('user.USER_SUSPENDED ').$time.trans('common.MINUTES'));
			}
			catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
			    return array('code'=>-5, 'message'=> trans('user.USER_BANNED'));
			}
		}

		return view('website::user.user.load');
	}

}