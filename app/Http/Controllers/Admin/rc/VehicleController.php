<?php namespace App\Http\Controllers\Admin\Resource;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ABaseController;
use App\Vehicle;

use Illuminate\Http\Request;

class VehicleController extends ABaseController
{

	private $validate = array();

	private $vehicle;

	public function __construct()
	{
		parent::__construct();
		$this->vehicle = new Vehicle();
		$this->validate = $this->vehicle->fillable;
	}

	public function index()
	{

	}

	public function lists()
	{
		$page = \Request::input('page');	//获取当前的页码
		if(!$page)
		{
			$page = 1;
		}
		$page_limit = 10;		// 每页显示信息的条数
		$offset = ($page -1) * $page_limit; // 当前页码的第一条的id
		$count_vehicle = \DB::table('vehicle')->count();
		$sum_page = ceil($count_vehicle/$page_limit); //总页数
		$vehicle = \DB::table('vehicle')
						->skip($offset)
						->take($page_limit)
						->orderBy('id','desc')
						->get();
		foreach($vehicle as & $x)
		{
			$area = $this->getArea($x->from_area_id);	//起始地址
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);

			$x->from['area'] = $area->area;
			$x->from['city'] = $city->city;
			$x->from['province'] = $province->province;

			$area = $this->getArea($x->to_area_id);		// 目的地址
			$city = $this->getCity($area->father);
			$province = $this->getProvince($city->father);

			$x->to['area'] = $area->area;
			$x->to['city'] = $city->city;
			$x->to['province'] = $province->province;

			$vehicle_type = $this->getVehicleType($x->vehicle_type);	//车辆类型
			$x->vehicle_type = $vehicle_type->type_name;

			$vehicle_body_type = $this->getVehicleBodyType($x->vehicle_body_type);	// 车身状况
			$x->vehicle_body_type = $vehicle_body_type->body_type_name;

		}
		return view('default.rc.vehicle.lists')->with('lists', $vehicle)->with('sum_page', $sum_page)->with('cur_page',$page);
	}

	// 添加货车信息
	public function add()
	{
		$method = \Request::method();
		$validate = $this->validate;

		$input_arr = array();
		$data_frame = $this->data_frame();
		if($method == 'POST')
		{
			foreach($validate as $x)
			{
				if(!empty(\Request::input($x)))
				{
					$input_arr[$x] = \Request::input($x);
				}
			}
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

		return view('default.rc.vehicle.form')->with('vehicle', $data_frame);

	}

	// // 编辑货车信息
	public function edit($id)
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
		$data->vehicle_types = $this->getAllVehicleType();
		$data->vehicle_body_types = $this->getAllVehicleBodyType();

		$area = $this->getArea($data->from_area_id);	//起始地
		$city = $this->getCity($area->father);
		$province = $this->getProvince($city->father);
		$this->areaSelectPlugin($province->provinceID, $city->cityID);
		$from['province'] = $province->provinceID;
		$from['city'] = $city->cityID;
		$from['area'] = $area->areaID;
		$data->from = $from;

		$area = $this->getArea($data->to_area_id);		// 目的地
		$city = $this->getCity($area->father);
		$province = $this->getProvince($city->father);
		$to['province'] = $province->provinceID;
		$to['city'] = $city->cityID;
		$to['area'] = $area->areaID;
		$data->to = $to;
		$this->areaSelectPlugin_2($province->provinceID, $city->cityID);
		return view('default.rc.vehicle.form')->with('vehicle', $data);
	}

	// // 删除货车信息
	public function delete($id)
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

}