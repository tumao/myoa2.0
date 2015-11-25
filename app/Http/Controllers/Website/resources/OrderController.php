<?php namespace App\Http\Controllers\Website\Order;

use App\Http\Controllers\Website\BaseController;
use App\Http\Controllers\Controller;
use App\Vehicle;		// model
use App\Merchandise;	// model

class OrderController extends BaseController
{

	private $userId;

	public function __construct()
	{
		parent::__construct();
		$this->userId = $this->getUserId();
	}

	public function index()
	{

	}

	// 选车下单
	public function addVehicleOrder($vehicleId)
	{
		$method = \Request::method();
		if($method == 'POST')	// 存储数据
		{
			$userId = $this->userId; //当前用户的id	
		}
		else 					// 展示信息
		{
			$vehicle = Vehicle::find($vehicleId);
			var_dump($vehicle);
		}

	}

	// 接货下单
	public function addMerchandiseOrder($merchandiseId)
	{
		$method = \Request::method();
		$merchandise = Merchandise::find($merchandiseId);
		if($method == 'POST')	// 存储数据
		{
			$userId = $this->userId;		//当前用户id
		}
		else 	// 展示信息
		{
			return view('website::resources.order.merchandiseOrder');
		}
	}

}
