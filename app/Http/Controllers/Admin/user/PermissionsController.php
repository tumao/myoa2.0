<?php namespace App\Http\Controllers\Admin\User;

use	App\Http\Controllers\Admin\ABaseController;
use App\Permission;

class PermissionsController extends ABaseController {

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
	 * 权限列表
	 *
	 * @return Response
	 */
	public function permissions()
	{
		$permissions = Permission::all();
		return \View::make('default.user.permissions.permissions')->with('permissions', $permissions);
	}

	/**
	 * 保存权限
	 *
	 * @return Response
	 */
	public function savePermissons()
	{
		$input = \Input::only('name', 'code');
		$per = Permission::firstOrCreate($input);
		return array('code'=>1, 'message'=>'ok');
	}

	/**
	 * 编辑权限
	 *
	 * @return Response
	 */
	public function editPermissions($id)
	{
		//
		$input = \Input::only('name', 'code');
		$permission = Permission::find($id);
		$permission->name = $input['name'];
		$permission->code = $input['code'];
		$permission->save();
		return array('code'=>1, 'message'=>'ok');
	}

	/**
	 * 删除权限
	 *
	 * @return Response
	 */
	public function delPermission($id)
	{
		Permission::destroy($id);
		return array('code'=>1, 'message'=> 'PERMISSION_DELETE_SUCCESS');
	}

}
