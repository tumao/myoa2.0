<?php namespace App\Http\Controllers\Website\Order;

use App\Http\Controllers\Website\BaseController;
use App\Http\Controllers\Website\Resources\VehiclesController;
use App\Http\Controllers\Website\Resources\MerchandiseController;
use App\Http\Controllers\Controller;
use App\Vehicle;		// model
use App\Merchandise;	// model
use App\Order; 			// model

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

	/*
	 *	列表, page 为 当前页码
	 */ 
	public function lists($page=1)
	{
		$order 	= new Order;
		$Vehicle = new VehiclesController;
		$Merchandise = new MerchandiseController;
		$userId = $this->getUserId();
		$perPage = 10; 		// 分页，每页展示信息的条数
		$sql 	= "SELECT * FROM `orders` WHERE `from_account_id`={$userId} OR `to_account_id`={$userId} ORDER BY  id DESC";
		$list 	= \DB::select($sql);
		$count 	= count($list); // 数据的总条数
		$sumPage = ceil($count/$perPage); //总页数
		$offset = $perPage * ($page - 1);
		$sql .= " LIMIT {$offset}, {$perPage}";
		$list = \DB::select($sql);
		foreach($list as & $item)
		{
			$order_status = $order->getOrderStatus($item->order_status);	// 根据订单状态id,获取状态对象
			$item->order_status = $order_status->status_name;
			if($item->order_type == 'vehicle')	//当前订单是货车司机下的订单，车源
			{
				$item->type = '车源';
				$vehicleInfo = $Vehicle->getVehicleInfo($item->id);
				$item->vehicleInfo = $vehicleInfo;
			}
			elseif($item->order_type == 'merchandise')	// 当前订单是货主下的订单，货源
			{
				$item->type = '货源';
				$merchandiseInfo = $Merchandise->getMerchandiseInfo($item->id);
				$item->merchandiseInfo = $merchandiseInfo;
			}
		}
		return view('website::user.user.orderList')->with('data', $list);


	}

	/*
	 *	oid is order id
	 */
	public function detail($oid)
	{
		$order = \DB::table('orders')->where('id', '=', $oid)->first();
		if($order->order_type == 'merchandise')
		{

		}
		elseif($order->order_type == 'vehicle')
		{
			
		}
	}

}
