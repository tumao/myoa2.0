<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('name', 'permissions', 'created_at', 'updated_at');

}