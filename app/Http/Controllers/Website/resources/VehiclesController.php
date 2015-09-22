<?php namespace App\Http\Controllers\Website\Resources;

use App\Http\Controllers\Website\BaseController;
use App\Http\Controllers\Controller;
use App\Vehicle;

// 车源
class VehiclesController extends BaseController
{

	private $validate = array();

	private $vehicle;

	public function __construct()
	{
		parent::__construct();
		$this->vehicle = new Vehicle();
		$this->validate = $this->vehicle->fillable;
	}

	public function lists()
	{
		$vali = array('vehicle_type', 'vehicle_body_type', 'vehicle_length', 'vehicle_weight','page');
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

		$data = array();
		$vehicle_type = $this->getAllVehicleTypes(); //所有的货车类型
		$vehicle_body_type = $this->getAllVehicleBodyTypes(); //获取所有的货车车身类型
		$where = '';
		if($checked['page'] == '')
		{
			$checked['page'] = 1;
		}
		$xdata = $this->vehicle->search($checked['from'], $checked['to'],$checked['vehicle_type'],$checked['vehicle_body_type'],$checked['vehicle_weight'], $checked['vehicle_length'], $checked['page']);
		$vehicles = $xdata['vehicles'];	//货车信息
		$sum_page = $xdata['sum_page'];	//总页数
		foreach($vehicles as & $x)
		{
			$vt = $this->getVehicleType($x->vehicle_type);
			$x->vehicle_type = $vt->type_name;
			$vbt = $this->getVehicleBodyType($x->vehicle_body_type);
			$x->vehicle_body_type = $vbt->body_type_name;
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
			$area = $this->getArea($x->location_id);
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);
			$x->location = $province->province.$city->city.$area->area;	//常住地
		}

		$data['checked'] = $checked;
		$data['vehicle_type'] = $vehicle_type;
		$data['vehicle_body_type'] = $vehicle_body_type;
		$data['vehicle_length'] = $this->vehicle_length_formate();
		$data['vehicle_weight'] = $this->vehicle_weight_formate();
		$data['vehicles'] = $vehicles;
		$data['sum_page'] = $sum_page;
		return view('website::resources.vehicles.lists')->with('data',$data);
	}

	public function add()
	{
		$method = \Request::method();
		$validate = $this->validate;

		$input_arr = array();
		$data_frame = $this->data_frame();
		$this->areaSelectPlugin();
		if($method == 'POST')
		{
			foreach($validate as $x)
			{
				if(!empty(\Request::input($x)))
				{
					$input_arr[$x] = \Request::input($x);
				}
			}
			$user_id = 1;
			$input_arr['user_id'] = $user_id;
			$vehicle = Vehicle::create($input_arr);
			if($vehicle)
			{
				return array('code'=> 1, 'message'=> '添加成功');
			}
			else
			{
				return array('code'=>-1, 'message'=> '添加失败');
			}
		}
		$data_frame['vehicle_type'] = $this->getAllVehicleType();
		$data_frame['vehicle_body_type'] = $this->getAllVehicleBodyType();
		return view('website::resources.vehicles.publish')->with('vehicle', $data_frame);
	}

	public function edit()
	{
		$method = \Request::method();
		if(isset($id))
		{
			$data = Vehicle::find($id);
		}
		else
		{
			return array('code'=> -1, 'message' => '缺少参数id');
		}
		if($method == 'POST')
		{
			$input_arr = array();
			$validate = $this->validate;
			foreach($validate as $x)
			{
				if(!empty(\Request::input($x)))
				{
					$input_arr[$x] = \Request::input($x);
				}
			}
			Vehicle::where('id', '=', $id)->update($input_arr);
			return array('code'=> 1, 'message'=> '数据更新成功');
		}
		return view('website::resources.vehicles.lists')->with('vehicle', $data);
	}

	public function delete()
	{
		if($id)
		{
			Vehicle::destroy($id);
			return array('code'=>1, 'message'=>'数据删除成功');
		}

		return array('code'=> -1, 'message'=> '缺少参数id');
	}


	private function data_frame()
	{
		$vali = $this->validate;
		$data_frame = array();
		foreach ($vali as $x)
		{
			$data_frame[$x] =  '';
		}
		return $data_frame;
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

	private function fetch_ids($area)
	{
		$ids = array();
		foreach($area as $item)
		{
			$ids[] = $item->areaID;
		}
		return implode(',', $ids);
	}

	public function getAreas()
	{
		$provinceID = \Request::input('provinceID');
		$cityID = \Request::input('cityID');

		if(!empty( $provinceID))
		{
			$city = $this->getAllCities($provinceID);
			if(!empty($city))
			{
				return $city;
			}
			else
			{
				return false;
			}
		}

		if(!empty( $cityID))
		{
			$area = $this->getAllAreas($cityID);
			if(!empty($area))
			{
				return $area;
			}
			else
			{
				return false;
			}
		}

	}

}