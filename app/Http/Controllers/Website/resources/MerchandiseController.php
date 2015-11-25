<?php namespace App\Http\Controllers\Website\Resources;

use App\Http\Controllers\Website\BaseController;
use App\Merchandise;

// 货源
class MerchandiseController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	// 列表
	public function lists()
	{
		$merchandise = new Merchandise;
		$vali = array('merchandise_type','merchandise_shipping_method','from','to','page');

		$checked = array();

		foreach($vali as $item)
		{
			if(\Request::input($item) != 0)
			{
				$checked[$item] = \Request::input($item);
			}
			else
			{
				$checked[$item] = '';
			}
		}

		if( \Request::input('from'))	// 起始地点
		{
			$checked['from'] = \Request::input('from');
		}
		else
		{
			$checked['from']= '';
		}
		if( \Request::input('to'))	// 目的地
		{
			$checked['to'] = \Request::input('to');
		}
		else
		{
			$checked['to'] = '';
		}
		if($checked['page'] == '')
		{
			$checked['page'] = 1;
		}

		$merchandise_type = $this->getAllMerchandiseType();
		$merchandise_shipping_method = $this->getAllMerchandiseSM();
		$xdata = $merchandise->search($checked['from'],$checked['to'],$checked['merchandise_type'],$checked['merchandise_shipping_method'],$checked['page']);
		$mer = $xdata['mer'];
		$sum_page = $xdata['sum_page'];
		foreach($mer as & $x)
		{
			$mt = $this->getMerchandiseType($x->merchandise_type);
			$x->merchandise_type = $mt->type_name;
			$sm = $this->getMerchandiseShippiingMethod($x->merchandise_shipping_method);
			$x->merchandise_shipping_method = $sm->shipping_method;
			$area = $this->getArea($x->from_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$x->from['area'] = $area->area;	// 始发地
			$x->from['city'] = $city->city;
			$x->from['province'] = $province->province;
			$area = $this->getArea($x->to_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$x->to['area'] = $area->area;	// 终点
			$x->to['city'] = $city->city;
			$x->to['province'] = $province->province;
		}

		$data['mer_type'] = $merchandise_type;
		$data['mer_shipping_type'] = $merchandise_shipping_method;
		$data['mer'] = $mer;
		$data['checked'] = $checked;
		$data['sum_page'] = $sum_page;
		return view('website::resources.merchandise.lists')->with('data', $data);
	}

	// 详情
	public function detail($id)
	{
		$detail = Merchandise::find($id);
		$merchandise_type = $this->getAllMerchandiseType();

		$detail->from_area_id = $this->getDetailAreaName($detail->from_area_id);
		$detail->to_area_id = $this->getDetailAreaName($detail->to_area_id);
		
		$merchandise_shipping_method = $this->getAllMerchandiseSM();
		$data['detail'] = $detail;
		$data['mer_type'] = $merchandise_type;
		$data['mer_shipping_type'] = $merchandise_shipping_method;

		$merchandise_type = $this->getMerchandiseType($detail->merchandise_type);
		$merchandise_shipping_method = $this->getMerchandiseShippiingMethod($detail->merchandise_shipping_method);
		$detail->merchandise_type = $merchandise_type->type_name;
		$detail->merchandise_shipping_method = $merchandise_shipping_method->shipping_method;
		return view('website::resources.merchandise.detail')->with('data', $data);
	}

	// 详情
	public function getMerchandiseInfo($id)
	{
		$detail = Merchandise::find($id);

		$detail->from_area_id = $this->getDetailAreaName($detail->from_area_id);
		$detail->to_area_id = $this->getDetailAreaName($detail->to_area_id);
		
		return $detail;
	}

	// 添加
	public function add()
	{
		$method = \Request::method();
		$data_frame = $this->data_frame();

		$this->areaSelectPlugin();
		if( $method == 'POST')
		{
			$vali = $this->vali();
			$input_arr = array();
			foreach($vali as $v)
			{
				if(!empty(\Request::input($v)))
				{
					$input_arr[$v] = \Request::input($v);
				}
			}
			if(!empty($input_arr))
			{
				$input_arr['user_id'] = 1;
				$input_arr['merchandise_status'] = 1; // 货物状态，默认为带配货
				$merchandise = Merchandise::create($input_arr);	//创建一条新记录
			}

			if(isset($merchandise))
			{
				return array('code'=> 1, 'message'=>'货源创建成功');
			}
			else
			{
				return array('code'=>-1, 'message'=> '货源创建失败');
			}
		}
		$place = array();
		$data_frame['merchandise_type'] = $this->getAllMerchandiseType();
		$data_frame['merchandise_shipping_method'] = $this->getAllMerchandiseSM();

		return view('website::resources.merchandise.publish')->with('mer', $data_frame);
	}

	// 修改
	public function edit($id)
	{
		$method = \Request::method();
		$user = \Sentry::getUser();
		$merchandise = \DB::select('SELECT * FROM `merchandise` WHERE `id`=:id AND `user_id`=:uid', ['id'=>$id, 'uid'=>$user->id]);
		$data['merchandise'] = $merchandise[0];
		$data['merchandise_type'] = $this->getAllMerchandiseType();
		$data['merchandise_shipping_method'] = $this->getAllMerchandiseSM();

		if($method == 'POST')
		{
			$input_arr = array();
			$vali = $this->vali();
			foreach($vali as $x)
			{
				if(!empty(\Request::input($x)))
				{
					$input_arr[$x] = \Request::input($x);
				}
			}
			Merchandise::where('id','=', $id)->update($input_arr);
			return array('code'=> 1, 'message'=> '数据更新成功');
		}

		if($data['merchandise'])
		{
			$from_area_id = $data['merchandise']->from_area_id;
			$to_area_id = $data['merchandise']->to_area_id;

			$area = $this->getArea($from_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$from['province'] = $province->provinceID;
			$from['city'] = $city->cityID;
			$from['area'] = $area->areaID;
			$this->areaSelectPlugin($province->provinceID, $city->cityID);	// 起始地

			$area = $this->getArea($to_area_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);

			$to['province'] = $province->provinceID;
			$to['city'] = $city->cityID;
			$to['area'] = $area->areaID;

			$this->areaSelectPlugin_2($province->provinceID, $city->cityID);	// 目的地

			$data['merchandise']->from = $from;
			$data['merchandise']->to = $to;
		}

		return view('website::user.user.edit_merchandise')->with('data', $data);
	}

	// 删除
	public function delete()
	{
		if($id)
		{
			Merchandise::destroy($id);
			return array('code'=>1, 'message'=> '数据删除成功');
		}
		return array('code'=> -1, 'message'=> '缺少参数id');
	}


	private function vali()
	{
		$vali = array(
				'from_area_id',
				'to_area_id',
				'merchandise_date',
				'contact_name',
				'phone',
				'merchandise_name',
				'merchandise_type',
				'merchandise_shipping_method',
				'merchandise_weight',
				'merchandise_volume',
				'merchandise_status',
				'info',
				'user_id',
				'create_time'
				);
		return $vali;
	}

	private function data_frame()
	{
		$vali = $this->vali();
		$data_frame = array();
		foreach($vali as $x)
		{
			$data_frame[$x] = '';
		}
		return $data_frame;
	}

	// 接货下单
	public function addMerchandiseOrder($merchandiseId)
	{
		$method = \Request::method();
		$merchandise = Merchandise::find($merchandiseId);
		
		if($method == 'POST')	// 存储数据
		{
			// $userId = $this->getUserId(); // 获取当前用户的id
			// $arr = 
			$from_account_id = \Request::input('driverId');	//下单者的id
			$to_account_id = \Request::input('userId'); 	// 被下单者的id
			$order_status = 1;	// 订单状态
			$merchandise_id  = $merchandiseId;
			$order_type = 'merchandise';
			$insertData = array(
					'from_account_id' 	=> $from_account_id,
					'to_account_id'		=> $to_account_id,
					'order_status'		=> $order_status,
					'order_type'		=> $order_type,
					'merchandise_id'	=> $merchandise_id,
					);
			$result = \DB::table('orders')->insert($insertData);	// 将数据插入数据库
			if($result)
			{
				return array('code' => 1,'message' => '订单已生成，订单需车主与货主双方共同确认生效，等待货主确认！');
				// echo "<script>alert('订单已生成，订单需车主与货主双方共同确认生效，等待货主确认！');</script>";
				// return \Redirect::to('\');
			}
			else
			{
				return array('code' => -1, 'message' => '订单生成失败!');
			}
		}
		else 	// 展示信息
		{
			$user = $this->getUserInfo();
			$detail = Merchandise::find($merchandiseId);
			$merchandise_type = $this->getAllMerchandiseType();

			$detail->from_area_id = $this->getDetailAreaName($detail->from_area_id);
			$detail->to_area_id = $this->getDetailAreaName($detail->to_area_id);
			
			$merchandise_shipping_method = $this->getAllMerchandiseSM();
			$data['detail'] = $detail;
			$data['mer_type'] = $merchandise_type;
			$data['mer_shipping_type'] = $merchandise_shipping_method;
			$data['driver_name'] = $user->username;
			$data['phone'] = $user->phone;
			$data['driver_id'] = $user->id;

			$merchandise_type = $this->getMerchandiseType($detail->merchandise_type);
			$merchandise_shipping_method = $this->getMerchandiseShippiingMethod($detail->merchandise_shipping_method);
			$detail->merchandise_type = $merchandise_type->type_name;
			$detail->merchandise_shipping_method = $merchandise_shipping_method->shipping_method;
			return view('website::resources.order.merchandiseOrder')->with('data', $data);
		}
	}

	// 接货下单
	public function merchandiseOrderDetail($merchandiseId)
	{
		$method = \Request::method();
		$merchandise = Merchandise::find($merchandiseId);
		
		if($method == 'POST')	// 存储数据
		{
			
		}
		else 	// 展示信息
		{
			$user = $this->getUserInfo();
			$detail = Merchandise::find($merchandiseId);
			$merchandise_type = $this->getAllMerchandiseType();

			$detail->from_area_id = $this->getDetailAreaName($detail->from_area_id);
			$detail->to_area_id = $this->getDetailAreaName($detail->to_area_id);
			
			$merchandise_shipping_method = $this->getAllMerchandiseSM();
			$data['detail'] = $detail;
			$data['mer_type'] = $merchandise_type;
			$data['mer_shipping_type'] = $merchandise_shipping_method;
			$data['driver_name'] = $user->username;
			$data['phone'] = $user->phone;
			$data['driver_id'] = $user->id;

			$merchandise_type = $this->getMerchandiseType($detail->merchandise_type);
			$merchandise_shipping_method = $this->getMerchandiseShippiingMethod($detail->merchandise_shipping_method);
			$detail->merchandise_type = $merchandise_type->type_name;
			$detail->merchandise_shipping_method = $merchandise_shipping_method->shipping_method;
			return view('website::resources.order.morderDetail')->with('data', $data);
		}
	}

}