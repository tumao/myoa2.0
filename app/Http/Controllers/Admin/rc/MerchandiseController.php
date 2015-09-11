<?php namespace App\Http\Controllers\Admin\Resource;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ABaseController;
use App\Merchandise;

use Illuminate\Http\Request;


class MerchandiseController extends ABaseController
{

	//
	public function index()
	{

	}

	public function lists()
	{
		$mer = \DB::select('SELECT * FROM `merchandise` ORDER BY id desc');
		return view('default.rc.merchandise.lists')->with('lists', $mer);
	}

	// 添加货源记录
	public function add()
	{
		$method = \Request::method();
		$data_frame = $this->data_frame();
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
		$provinces = $this->getProvinces();
		$cities = $this->getAllCities($provinces[0]->provinceID);
		$areas = $this->getAreas($cities[0]->cityID);	//城市
		$place['province'] = $provinces;
		$place['city'] = $cities;
		$place['area'] = $areas;
		$data_frame['place'] = $place;

		return view('default.rc.merchandise.form')->with('mer', $data_frame);

	}
	// 编辑货源记录
	public function edit($id)
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

	// 删除货源记录
	public function delete($id)
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

	// 获取所有省份
	public function getProvinces()
	{
		$p = $this->getAllProvinces();
		return $p;
	}

	// 获取对应省份下的城市
	public function getCities($pid)
	{
		$c = $this->getAllCities($pid);
		return $c;
	}

	// 获取城市下对应的地区
	public function getAreas($cid)
	{
		$a = $this->getAllAreas($cid);
		return $a;
	}
}
