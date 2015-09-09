<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Picture;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	// 获取图片的url
	public function getPicUrl($id)
	{
		$pic = Picture::find($id);
		return $pic['path'];
	}

	// 上传图片
	public function addPic($file)
	{
		$pub_dir = public_path();
		$path = '/default/app/img/';
		$date = date('Y-m-d');
		$path = $path.$date.'/';
		$upload_dir = $pub_dir.$path;
		if(!is_dir($upload_dir))
		{
			$result = mkdir($upload_dir, 0777);
			if(!$result)
			{
				throw new Exception("目录权限问题，请检查", 1);
			}
		}
		$user = \Session::get('currentUser');

		$name = time().$user['id'];
		$ext = $file->guessClientExtension();
		$name = md5($name).'.'.$ext;
		if($file->isValid())
		{
			$file->move($upload_dir, $name);
		}
		$pic = Picture::create(array('path'=>$path.$name, 'status'=>'1'));
		return $pic;
	}

	private function get_pic_ext($picname)
	{
		$ext = substr($picname, strpos($picname, '.')+1);
		return $ext;
	}

}
