<?php namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\ABaseController;
use App\Role;
use App\Permission;

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
		$dbrole = new Role();
		$permissions = Permission::all();
		if($id != '')
		{
			$role = Role::findOrFail($id);
			foreach($permissions as & $permission)
			{
				if($dbrole->hasPermission($role, $permission['id']))
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
			$role = array(
				'id'	=> '',
				'name'	=> '',
				'display_name'	=> '',
				);
		}
		$data['group'] = $role;
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
		$input = \Input::only('name', 'display_name', 'permissions');
		//
		$role =  new Role();
		$role->name = $input['name'];
		$role->display_name = $input['display_name'];
		$result = $role->save();
		$permissions = $input['permissions'];
		foreach($permissions as $permission)
		{
			$per = Permission::where('name', '=', $permission)->first();
			$role->attachPermission($per);
		}
		if( $result)
		{
			return array('code'=>1, 'message'=>trans('user.ROLE_CREATE_SUCCESS'));
		}
		else
		{
			return array('code'=>0, 'message'=>trans('user.ROLE_CREATE_FAILS'));
		}
	}

	/**
	 * 更新角色
	 *
	 * @return Response
	 */
	public function updateGroup($id)
	{
		$dbRole = new Role();
		$input = \Input::all();
		$role = Role::findOrFail($id);
		if($role)
		{
			if(isset($input['name']))
			{
				$role->name = $input['name'];
			}
			if(isset($input['display_name']))
			{
				$role->display_name = $input['display_name'];
			}
			$role->save();
		}
		else
		{
			return array('code'=> 0, 'message'=>trans('user.ROLE_NOT_EXISTS'));
		}
		if($permissions = $input['permissions'])
		{
			$dbRole->delAllPerms($role);		//删除当前角色所有的权限
			foreach($permissions as $permission)	//为角色依次重新添加权限
			{
				$perms = Permission::where('name', '=', $permission)->first();
				if(!$dbRole->hasPermission($role, $perms['id']))
				{
					$role->attachPermission($perms);
				}
			}
		}
		return array('code'=>1, 'message'=> trans('user.ROLE_UPDATE_SUCCESS'));
	}

	/**
	 * 删除角色
	 *
	 * @return Response
	 */
	public function delGroup($id)
	{
		$role = Role::findOrFail($id);
		$role->users()->sync([]);
		$role->perms()->sync([]);
		$role->forceDelete();
		return array('code'=>1, 'message'=>trans('user.ROLE_DELETE_SUCCESS'));
	}
}
