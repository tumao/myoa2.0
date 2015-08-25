<?php namespace App\Http\Controllers\Admin\Resource;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ABaseController;

use Illuminate\Http\Request;

class VehicleController extends ABaseController
{

	public function index()
	{

	}

	public function lists()
	{
		$vehicle = \DB::table('vehicle')
						->orderBy('id','desc')
						->get();
		return view('default.rc.vehicle.lists')->with('lists', $vehicle);
	}
}