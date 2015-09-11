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
		$vehicle = \DB::table('vehicle')
						->orderBy('id','desc')
						->get();
		return view('default.rc.vehicle.lists')->with('lists', $vehicle);
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