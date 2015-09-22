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
		return view('website::resources.merchandise.lists')->with('data', $data);
	}

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
		// $provinces = $this->getProvinces();
		// $cities = $this->getAllCities($provinces[0]->provinceID);
		// $areas = $this->getAreas($cities[0]->cityID);	//城市
		// $place['province'] = $provinces;
		// $place['city'] = $cities;
		// $place['area'] = $areas;
		// $data_frame['place'] = $place;
		$data_frame['merchandise_type'] = $this->getAllMerchandiseType();
		$data_frame['merchandise_shipping_method'] = $this->getAllMerchandiseSM();

		return view('website::resources.merchandise.publish')->with('mer', $data_frame);
	}

	public function edit()
	{
		$method = \Request::method();
		if(isset( $id))
		{
			$data = Merchandise::find($id);
		}
		else
		{
			return array('code' => -1, 'message'=> '找不到参数id');
		}
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

		return view('default.rc.merchandise.form')->with('mer', $data);
	}

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

}