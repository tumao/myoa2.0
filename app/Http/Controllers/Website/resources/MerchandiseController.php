<?php namespace App\Http\Controllers\Website\Resources;

use App\Http\Controllers\Website\BaseController;

// 货源
class MerchandiseController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lists()
	{
		$mer = \DB::table('merchandise')->get();
		return view('website::resources.merchandise.lists')->with('lists', $mer);
	}

}