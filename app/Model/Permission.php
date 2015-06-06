<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $table = 'permissions';

	protected $fillable = array('name', 'display_name', 'description');

	public $timestamps = false;
}