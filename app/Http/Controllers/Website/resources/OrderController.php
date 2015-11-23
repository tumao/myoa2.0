<?php namespace App\Http\Controllers\Website\Order;

use App\Http\Controllers\Website\BaseController;
use App\Http\Controllers\Controller;
use App\Vehicle;

class OrderController extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

	}

	// 选车下单
	public function addVehicleOrder($vehicleId)
	{
		return "this is vehicle $vehicleId";
	}

	// 接货下单
	public function addMerchandiseOrder($merchandiseId)
	{
		return "this is merchandise order id $merchandiseId";
	}

}
