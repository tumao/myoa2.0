<?php namespace App\Http\Controllers\Admin\Index;

use App\Http\Controllers\Admin\ABaseController;

class DashboardController extends ABaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//系统信息
		// return view('default.index.census.index');
		return \Redirect::to('admin/dashboard/sys');
	}
}
