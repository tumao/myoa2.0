<?php
	namespace App;
	use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
	protected $table = 'common_picture';

	protected $fillable = array('path', 'status');

	public $timestamps = false; //不对 updated_at 进行更新

	public function savePic($path, $type, $name)
	{
		\DB::table($this->table)->insert(['path'=> $path, 'type'=> $type, 'name'=>$name]);
	}

	public function getJm()
	{
		$pics = \DB::select("SELECT * FROM {$this->table} WHERE `type`=:type",['type'=>'scroll_pic']);
		return $pics;
	}

	public function delPic($id)
	{
		\DB::table($this->table)->where('id','=',$id)->delete();
	}
}

 ?>