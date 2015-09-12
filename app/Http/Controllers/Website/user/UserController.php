<?php namespace App\Http\Controllers\Website\User;

use App\Http\Controllers\Website\BaseController;
use App\Http\Controllers\Controller;

// 车源
class UserController extends BaseController
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

	public function self()
	{
		return view('website::user.user.self');
	}

	public function secret()
	{
		return view('website::user.user.secret');
	}

	public function vehicle()
	{
		return view('website::user.user.vehicle');
	}

	public function merchandise()
	{
		return view('website::user.user.merchandise');
	}
}