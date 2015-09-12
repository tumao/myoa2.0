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
		$vehicles = \DB::table('vehicle')->get();
		return view('website::resources.vehicles.lists')->with('lists',$vehicles);
	}

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


}