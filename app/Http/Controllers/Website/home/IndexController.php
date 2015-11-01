<?php namespace App\Http\Controllers\Website\Home;

use App\Http\Controllers\Website\BaseController;
use App\Picture;

// 首页
class IndexController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($tag='default')
	{
		$data = array();
		$Pic = new Picture;
		$pics = $Pic->getJm();
		$merchandise = \DB::select('SELECT * FROM `merchandise` ORDER BY id DESC LIMIT 5');
		$vehicle = \DB::select('SELECT * FROM `vehicle` ORDER BY id DESC LIMIT 5');
		foreach($merchandise as & $x)
		{
			$from_area = $this->getArea($x->from_area_id);
			$city = $this->getCity($from_area->father);
			$province = $this->getProvince($city->father);
			$x->from['area'] = $from_area->area;
			$x->from['city'] = $city->city;
			$x->from['province'] = $province->province;
			$to_area = $this->getArea($x->to_area_id);
			$city = $this->getCity($to_area->father);
			$province = $this->getProvince($city->father);
			$x->to['area'] = $from_area->area;
			$x->to['city'] = $city->city;
			$x->to['province'] = $province->province;

			$merchandise_type = $this->getMerchandiseType($x->merchandise_type);
			$merchandise_status = $this->getMerchandiseStatus($x->merchandise_status);

			$x->merchandise_type = $merchandise_type->type_name;
			$x->merchandise_status = $merchandise_status->status_name;
		}
		foreach($vehicle as & $x)
		{
			$from_area = $this->getArea($x->from_area_id);
			$city = $this->getCity($from_area->father);
			$province = $this->getProvince($city->father);
			$x->from['area'] = $from_area->area;
			$x->from['city'] = $city->city;
			$x->from['province']  = $province->province;
			$to_area = $this->getArea($x->to_area_id);
			$city = $this->getCity($to_area->father);
			$province = $this->getProvince($city->father);
			$x->to['area'] = $from_area->area;
			$x->to['city'] = $city->city;
			$x->to['province'] = $province->province;

			$vehicle_body_type = $this->getVehicleBodyType($x->vehicle_body_type);
			$vehicle_type = $this->getVehicleType($x->vehicle_type);

			$x->vehicle_type = $vehicle_type->type_name;
			$x->vehicle_body_type = $vehicle_body_type->body_type_name;
		}
		
		if($tag == 'default')
		{
			$merchandise_type = $this->getAllMerchandiseType();
			$merchandise_shipping_method = $this->getAllMerchandiseSM();
			$data['mer_type'] = $merchandise_type;
			$data['mer_shipping_type'] = $merchandise_shipping_method;
		}
		elseif($tag == 'cy')
		{
			$vehicle_type = $this->getAllVehicleTypes(); //所有的货车类型
			$vehicle_body_type = $this->getAllVehicleBodyTypes(); //获取所有的货车车身类型
			$data['vehicle_type'] = $vehicle_type;
			$data['vehicle_body_type'] = $vehicle_body_type;
			$data['vehicle_length'] = $this->vehicle_length_formate();
			$data['vehicle_weight'] = $this->vehicle_weight_formate();
		}
		
		$data['checked']['from'] = '';
		$data['checked']['to'] = '';
		$data['merchandise'] = $merchandise;
		$data['vehicle'] = $vehicle;
		$data['isHomePage'] = true;	//当前页面是首页
		$data['checked']['tag'] = $tag;
		return view('website::home.home')->with('data', $data)->with('pic', $pics);
	}


	// 货车车长
	private function vehicle_length_formate()
	{
		$length_conf = array();
		$length_conf[] = array('between'=>'2,5', 'name'=>'2-5米');
		$length_conf[] = array('between'=>'6,8', 'name'=>'6-8米');
		$length_conf[] = array('between'=>'9,10', 'name'=>'9-10米');
		$length_conf[] = array('between'=>'11,12', 'name'=>'11-12米');
		$length_conf[] = array('between'=>'13,15', 'name'=>'13-15米');
		$length_conf[] = array('between'=>'16,17.5', 'name'=>'16-17.5米');
		$length_conf[] = array('between'=>'17.5', 'name'=>'17.5米以上');
		return $length_conf;
	}

	// 载重
	private function vehicle_weight_formate()
	{
		$vehicle_weight = array();
		$vehicle_weight[] = array('between' => '2,5', 'name' => '2-5吨');
		$vehicle_weight[] = array('between' => '6,10', 'name' => '6-10吨');
		$vehicle_weight[] = array('between' => '11,15', 'name' => '11-15吨');
		$vehicle_weight[] = array('between' => '16,20', 'name' => '16-20吨');
		$vehicle_weight[] = array('between' => '21,25', 'name' => '21-25吨');
		$vehicle_weight[] = array('between' => '26,30', 'name' => '26-30吨');
		$vehicle_weight[] = array('between' => '30', 'name' => '30吨以上');
		return $vehicle_weight;
	}

		// 所有的货车类型
	private function getAllVehicleTypes()
	{
		$vehicle_types = \DB::select('SELECT * FROM `vehicle_type`');
		return $vehicle_types;
	}

	// 所有的货车车身类型
	private function getAllVehicleBodyTypes()
	{
		$vehicle_body_types = \DB::select('SELECT * FROM `vehicle_body_type`');
		return $vehicle_body_types;
	}

}