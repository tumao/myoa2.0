<?php namespace App\Http\Controllers\Website\Home;

use App\Http\Controllers\Website\BaseController;

// 首页
class IndexController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array();
		$merchandise = \DB::select('SELECT * FROM `merchandise` ORDER BY id desc LIMIT 5');
		$vehicle = \DB::select('SELECT * FROM `vehicle` ORDER BY id desc LIMIT 5');
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
		$data['merchandise'] = $merchandise;
		$data['vehicle'] = $vehicle;
		return view('website::home.home')->with('data', $data);
	}

}