<?php namespace App\Http\Controllers\Admin\Resource;

use App\Http\Controllers\Admin\ABaseController;
use App\Picture;

class RcController extends ABaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		// return \Redirect::to('admin/rc/vehicle');
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
		if(\Request::hasFile('photo'))
		{
			$file = \Request::file('photo');
			$pic = $this->addPic($file); 	//参数 file
			// return \Redirect::to('admin/rc/lists');
			echo '图片上传成功...';exit;
		}
		return view('default.rc.resources.uploadForm');
	}

}
