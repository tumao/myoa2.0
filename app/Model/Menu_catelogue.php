<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_catelogue extends Model {

	//
	protected $table = 'menu_catelogue';

	protected $fillable = array('name', 'icon', 'root', 'sort', 'path');

	public $timestamps = false;

}
