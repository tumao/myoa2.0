<?php namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\ABaseController;
use App\Role;

class RoleController extends ABaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * 分组列表
	 *
	 * @return Response
	 */
	public function roles()
	{
		$groups = Role::all();
		return \View::make('default.user.group.group')->with('groups', $groups);
	}

	/**
	 * 添加用户组 对话框
	 *
	 * @return Response
	 */
	public function groupForm($id = '')
	{
		$data = array();
		$permissions = \Permission::all();
		// $permissionsVal = $this->fetchArrayVal($permissions, 'code');
		if($id != '')
		{
			$group = \Sentry::findGroupById($id);
			foreach($permissions as & $permission)
			{
				if($group->hasAccess($permission['code']))
				{
					$permission['checked'] = true;
				}
				else
				{
					$permission['checked'] = false;
				}
			}
		}
		else
		{
			$group = array(
				'id'	=> '',
				'name'	=> '',
				);
		}
		$data['group'] = $group;
		$data['permissions'] = $permissions;
		return \View::make('default.user.group.groupForm')->with('data', $data);
	}

	/**
	 * 取出数组中键 对应的 值
	 *
	 * @return Response
	 */
	private function fetchArrayVal($array, $key)
	{
		$valArray = array();
		foreach($array as $item)
		{
			$valArray[] = $item[$key];
		}
		return $valArray;
	}

	/**
	 * 创建用户组
	 *
	 * @return Response
	 */
	public function createGroup()
	{
		$input = \Input::only('name', 'permissions');
		//
		try
		{
		    // Create the group
		    $group = \Sentry::createGroup($input);
		    return array('code'=>1, 'message'=>'GROUP_CREATE_SUCCESS');
		}
		catch (\Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    return array('code'=>-1, 'message'=>'GROUP_NAME_REQUIRED');
		}
		catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    return array('code'=>-2, 'message'=>'GROUP_ALREADY_EXISTS');
		}
	}

	/**
	 * 创建用户组
	 *
	 * @return Response
	 */
	public function updateGroup($id)
	{
		$input = \Input::all();
		try
		{
			$group = \Sentry::findGroupById($id);
			if( isset($input['name']))
			{
				$group->name = $input['name'];	
			}
			if( isset( $input['permissions']))
			{
				$group->permissions = $input['permissions'];	
			}
			if($group->save())
			{
				return array('code'=> 1, 'message'=> 'GROUP_UPDATED_SUCCESS');
			}
			else
			{
				return array('code'=>-1, 'message'=> 'GROUP_UPDATED_FAILED');
			}
		}
		catch (\Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    return array('code'=>-2, 'message'=> 'GROUP_NAME_REQUIRED');
		}
		catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			return array('code'=>-3, 'message'=> 'GROUP_EXISTS');
		}
		catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			return array('code'=>-4, 'message'=> 'GROUP_NOT_FOUND');
		}
	}

	/**
	 * 删除组
	 *
	 * @return Response
	 */
	public function delGroup($id)
	{
		try
		{
		    // 查找组
		    $group = \Sentry::findGroupById($id);

		    // 删除该组
		    $group->delete();
		    return array('code'=>1, 'message'=>'DEL_SUCCESS');
		}
		catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    return array('code'=>-1, 'message'=>'GROUP_NOT_FOUND');
		}
	}
}
