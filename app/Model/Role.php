<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $table = 'role';

	protected $filllable =  array('name', 'display_name', 'description');

	public $timestamps = false;

	/**
	 *	查看角色是否有权限
	 *
	 *	role(obj) 角色， permission_id(num) 权限id
	 *
	 */
	public function hasPermission($role, $permissionId)
	{
		$condition = \DB::select("SELECT * FROM `permission_role` WHERE `permission_id` = {$permissionId} AND `role_id` = {$role['id']}");
		if($condition)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 *	移除角色的所有权限（不可恢复的）
	 *
	 *	role(obj) 角色
	 *
	 */
	public function delAllPerms($role)
	{
		\DB::delete("DELETE FROM `permission_role` WHERE `role_id` = {$role['id']}");
		return true;
	}
}