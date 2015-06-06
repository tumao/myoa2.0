<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 *	用户移除某个角色
	 *
	 *
	 *
	 */
	public function userRemoveRoles($user, $roleId)
	{
		\DB::delete("DELETE FROM `role_user` WHERE `user_id` = {$user['id']} AND `role_id` = {$roleId}");
		return true;
	}

	/**
	 *	用户移除所有角色
	 *
	 *
	 *
	 */
	public function userRemoveAllRoles($user)
	{
		\DB::delete("DELETE FROM `role_user` WHERE `user_id` = {$user['id']}");
		return true;
	}

}
