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
		return \Redirect::to('/admin/user/userconf');
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
		$register = new Registrar;
		$request = \Request::only('username', 'password', 'remember');
		$validator = $register->userLoadValidator($request);	//判断用户登录信息是否填写完整
		if( !$validator->fails())
		{
			if(Auth::attempt(array('email' => $request['username'], 'password'=> $request['password']), $request['remember']))
			{
				return array('code' => 1, 'info' => trans('user.IS_LOADING'), 'redirect_url' => '/');  //redirect_url 为登录成功后跳转的页面
			}
			else
			{
				return array('code' => 0, 'info' => trans('user.USERNAME_PASSWORD_NOT_MATCH')); 	//调用语言包中的自定义...
			}
		}
		else
		{
			$messages = $validator->messages();
			return array( 'code' => 0, 'info' => $messages->first());
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
		$validator = $register->validator($data);	//通过Registrar类中的验证方法验证输入信息

		if(!$validator->fails())
		{
			$result = $register->create($data);

			if($result)
			{
			    return array('code' => 1, 'info' => '用户创建成功');
			}
		}
		else
		{
			$messages = $validator->messages();		//获取验证失败信息 $messages->firest :返回验证失败信息中的第一条
			return array('code' => 0, 'info'=> $messages->first());
		}


	}

	/**
	 * 用户列表
	 *
	 * @return Response
	 */
	public function userList()
	{
		$all_users = User::all();
		return \View::make('default.user.user.user')->with('users', $all_users);
	}

	/**
	 * 添加、修改 用户信息页面(当id为空时，则添加，id非空时为修改数据)
	 * @param id（可选参数） 用户id
	 *
	 * @return TRUE 删除成功
	 * @return FALSE 删除失败
	 */
	public function userForm($id = '')
	{
		$groups = \Sentry::findAllGroups();
		$user = array(
			'id'	=> '',
			'name'	=> '',
			'email'	=> '',
			'first_name' => ''
			);
		if( $id != '')
		{
			$user = \Sentry::findUserById($id);
			$group = $user->getGroups();
		}
		foreach($groups as & $x)
		{
			if( $id != '' && $x['name'] == $group[0]['name'])	//如果是修改页面则设置分组
			{
				$x['checked'] = true;
			}
			else if( $id == '' && $x['name'] == 'Users')	//如果是添加页面则设置默认分组为users
			{
				$x['checked'] = true;
			}
			else
			{
				$x['checked'] = false;
			}
		}
		$data = array(
			'user'	=> $user,
			'group'	=> $groups
			);
		return \View::make('default.user.user.userForm')->with('data', $data);
	}

	public function logout()
	{
		if(Auth::check())
		{
			Auth::logout();
			return \Redirect::to('/admin');		//跳转到登录页面
		}
	}
}
