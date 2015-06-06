<?php namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use App\Http\Controllers\Admin\ABaseController;

use Illuminate\Http\Request;
use App\User;			//model
use App\Role;
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
		if(\Request::isMethod('post'))
		{
			$user = \Input::all();
		}
	    // Create the user
		    // $user_info = \Sentry::createUser(array(
		    // 	'real_name'	=> $user['real_name'],
		    //     'email'     => $user['email'],
		    //     'password'  => $user['password'],
		    //     'activated' => true,
		    // ));
		$data = array(
			'name'	=> $user['username'],
			'email'	=> $user['email'],
			'password'	=> $user['password']
			);
		$register = new Registrar;
		$validator = $register->validator($data);	//通过Registrar类中的验证方法验证输入信息

		if(!$validator->fails())
		{
			$registeredUser = $register->create($data);		//添加用户
			$registeredUser->roles()->attach($user['roleId']);	//为用户添加分组

			if($registeredUser)
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
		$roles = Role::all();
		$user = array(
			'id'	=> '',
			'name'	=> '',
			'email'	=> '',
			);
		if( $id != '')
		{
			$user = User::findOrFail($id);
			foreach($roles as & $x)
			{
				if($user->hasRole([$x['name']]))
				{
					$x['checked'] = true;
				}
				else
				{
					$x['checked'] = false;
				}
			}
		}
		$data = array(
			'user'	=> $user,
			'group'	=> $roles
			);
		return \View::make('default.user.user.userForm')->with('data', $data);
	}

	/**
	 * 更新用户信息
	 *
	 * @param
	 *
	 * @return
	 */
	public function updateUser()
	{
		$dbUser = new User();
		if(\Request::isMethod('post'))
		{
			$user = \Input::all();
		}
	    $user_info = User::findOrFail($user['id']);		//通过id查找用户

	    // 更新用户信息
	    // $user_info->name = $user['username'];
	    $user_info->email = $user['email'];
	    $user_info->name = $user['username'];
	    $dbUser->userRemoveAllRoles($user_info);
	    // $this->assign_group_to_user($user['id'],array($user['groupName']));
	    $user_info->roles()->attach($user['roleId']);
	    if ($user_info->save())									//保存修改
	    {
	        return array('code'	=>1, 'info' => '数据修改成功');
	    }
	    else
	    {
	        // User information was not updated
	        return array('code' => 0, 'info' => '数据保存失败，请联系管理员！');
	    }
	}

	/**
	 * 用户注册/管理员创建用户
	 *
	 * @return Response
	 */
	public function passReset()
	{
		if(\Request::isMethod('post'))
		{
			$input = \Input::only('id','password');
		}
		$user = \Sentry::findUserById($input['id']);
		$user->password = $input['password'];
		$user->save();
		return array('code'=> 1, 'message'=> 'PASSWORD_RESET_SUCCESS');
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
