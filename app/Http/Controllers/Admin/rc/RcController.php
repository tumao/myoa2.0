<?php namespace App\Http\Controllers\Admin\Resource;

use App\Http\Controllers\Admin\ABaseController;
use App\Picture;

class RcController extends ABaseController {


	private $DOCUMENT_ROOT;

	public function __construct()
	{
		parent::__construct();
		$this->DOCUMENT_ROOT =$_SERVER['DOCUMENT_ROOT'];
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return \Redirect::to('admin/rc/merchandise');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function lists()
	{
		$pics = Picture::all();
		return view('default.rc.resources.lists')->with('pics', $pics);
	}

	public function add()
	{
		$date = date("Y-m-d");
		$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];	// root of the web
		$targetFolder = "/default/app/img/{$date}/"; // Relative to the web root
		$targetPath = $DOCUMENT_ROOT.$targetFolder;
		if (!empty($_FILES))
		{
			$Pic = new Picture;
			$User = \Sentry::getUser();
			if(!is_dir($targetPath))
			{
				mkdir($targetPath, 0777);
			}
			$tempFile = $_FILES['Filedata']['tmp_name'];
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			$extension = $fileParts['extension'];
			$newPicName = md5($_FILES['Filedata']['name'].time().$User->id).'.'.$extension;	// new name of picture
			$targetFile = rtrim($targetPath, '/').'/'.$newPicName;
			$Pic->savePic($targetFolder.$newPicName, 'scroll_pic', trim($_FILES['Filedata']['name']));
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				// echo '1';
				echo "<script>window.location.reload();</script>";
			} else {
				echo 'Invalid file type.';
			}
		}
		return view('default.rc.resources.uploadForm');
	}

	// 图片列表
	public function picture()
	{
		return view('default.rc.resources.lists')->with('pics', $pics);
	}

	// 删除图片
	public function delPic($id)
	{
		$pic = Picture::find($id);
		$Pic = new Picture;
		$DOCUMENT_ROOT = $this->DOCUMENT_ROOT;
		if(unlink($DOCUMENT_ROOT.$pic->path))
		{
			$Pic->delPic($id);
			return array('code' => 1, 'message'=> '删除成功');
		}
	}
}
