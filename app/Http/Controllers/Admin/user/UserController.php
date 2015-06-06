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

	/**
	 * 登录页面
	 *
	 * @return Response
	 */
	public function show()
	{
		if(\Sentry::check())
		{
			return \Redirect::to('/admin/dashboard');
		}
		return \View::make("default.user.login");
	}

	/**
	 * 登录时校验用户登录信息
	 *
	 * @return Response
	 */
	public function auth()
	{
		//获取用户输入的信息
		$request = \Request::only('username', 'password', 'remember');
		try
		{
			$auths = array(
				'email'	=> $request['username'],
				'password'	=> $request['password']
				);
			$remember = $request['remember'] ? $request['remember'] : false;
			$result = \Sentry::authenticate( $auths, $remember);
			if($result)
			{
				return array('code'=>1, 'message'=>'LOGIN_SUCCESS', 'redirect_url' => '/admin/dashboard');
			}
		}
		catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return array('code'=>-1, 'message'=>'LOGIN_FIELD_REQUIRED');
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return array('code'=>-2, 'message'=> 'USER_NOT_FOUND');
		}
		catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    return array('code'=>-3, 'message'=>'USER_NOT_ACTIVATED');
		}

		catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    $time = $throttle->getSuspensionTime();

		    return array('code'=>-4, 'message'=>'USER_SUSPENDED '.$time.'MINUTES');
		}
		catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    return array('code'=>-5, 'message'=> 'USER_BANNED');
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
		try
		{
		    // Create the user
		    $user_info = \Sentry::createUser(array(
		    	'username'	=> $user['username'],
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

	/**
	 * 用户列表
	 *
	 * @return Response
	 */
	public function userList()
	{
		$all_users = \Sentry::findAllUsers();
		foreach ($all_users as & $user)
		{

			$group_arr = array();
			$x = \Sentry::findUserById($user['id']);
			$groups = $x->getGroups();
			foreach($groups as $group)
			{
				array_push($group_arr, $group['name']);
			}
			$user['group'] = implode(',', $group_arr);
		}
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
			'username'	=> '',
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
			if(is_object($user) && $user->inGroup($x))
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

	/**
	 * 更新用户信息
	 *
	 * @param
	 *
	 * @return
	 */
	public function updateUser()
	{
		if(\Request::isMethod('post'))
		{
			$user = \Input::all();
		}
		try
		{
		    $user_info = \Sentry::findUserById($user['id']);		//通过id查找用户

		    // 更新用户信息
		    // $user_info->name = $user['username'];
		    $user_info->email = $user['email'];
		    $user_info->username = $user['username'];
		    $this->assign_group_to_user($user['id'],array($user['groupName']));
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
		catch (\Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    return array('code' => -1, 'info' => '用户名已经存在');
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return array('code' => -2, 'info' => '未找到要修改的用户');
		}
	}

	/**
	 * 给用户重新分配组
	 *
	 * @param $user_id, (array)$group = array('group1','group2')
	 *
	 * @return
	 */

	private function assign_group_to_user($user_id, $group)
	{
		try
		{
		    // Find the user using the user id
		    $user = \Sentry::findUserById($user_id);

		    $old_groups = $user->getGroups();		//用户原有的组
		    foreach( $old_groups as $old_group)			//删除用户原有的所有组
		    {
		    	$x = \Sentry::findGroupById($old_group['id']);
		    	$user->removeGroup($x);
		    }
		    foreach($group as $gName)				//给用户分配新的组
		    {
		    	$x = \Sentry::findGroupByName($gName);
		    	$user->addGroup($x);
		    }
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
	}

	/**
	 * 删除用户
	 * @param user_id 用户id
	 *
	 * @return TRUE 删除成功
	 * @return FALSE 删除失败
	 */
	public function delUser($id)
	{
		try
		{
			$cur_user =  \Sentry::getUser();
			if( $cur_user->hasAccess('user.delete'))
			{
				$user = \Sentry::findUserById($id);	// 通过id查找用户
		    	$user->delete();	// 删除用户
		    	return array('code' => 1, 'info'=> '删除成功');
			}
			else
			{
				return array('code' => -1,'info'=> '当前用户无权限删除用户!');
			}

		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return array('code' => -2, 'info' => '用户不存在');	//用户不存在 （用户不存在或者被软删除）
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

	/**
	 *	退出登录
	 *
	 *
	 */
	public function logout()
	{
		\Sentry::logout();
		return \Redirect::to('admin');
	}
}
