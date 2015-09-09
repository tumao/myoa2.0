<?php
	namespace App;
	use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
	protected $table = 'common_picture';

	protected $fillable = array('path', 'status');

	public $timestamps = false; //不对 updated_at 进行更新
}

 ?>