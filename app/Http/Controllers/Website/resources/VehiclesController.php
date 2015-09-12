<?php namespace App\Http\Controllers\Website\Resources;

use App\Http\Controllers\Website\BaseController;

// 车源
class VehiclesController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lists()
	{
		$vehicles = \DB::table('vehicle')->get();
		return view('website::resources.vehicles.lists')->with('lists',$vehicles);
	}
}