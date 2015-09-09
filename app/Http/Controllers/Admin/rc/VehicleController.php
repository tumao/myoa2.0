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
		$this->vehicle = new Vehicle();
		$this->validate = $this->vehicle->fillable;
	}

	public function index()
	{

	}

	public function lists()
	{
		echo 111;exit;
		$vehicle = \DB::table('vehicle')
						->orderBy('id','desc')
						->get();
		return view('default.rc.vehicle.lists')->with('lists', $vehicle);
	}

	// 添加货车信息
	public function add()
	{
		$validate = $this->validate;

		$input_arr = array();

		foreach($validate as $x)
		{
			if(isset(Request::input($x)))
			{
				$input_arr[$x] = Request::input($x);
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

	// 编辑货车信息
	public function edit()
	{
		$id = Request::input('id');
		if(Request::ajax())
		{
			$input_arr = array();
			$validate = $this->validate;
			foreach($validate as $x)
			{
				if(isset(Request::input($x)))
				{
					$input_arr[$x] = Request::input($x);
				}
			}
			Vehicle::where('id', '==', $id)->update($input_arr);
			return array('code'=> 1, 'message'=> '数据更新成功');
		}
		$data = Vehicle::find($id);
	}

	// 删除货车信息
	public function delete()
	{
		$id = Request::input('id');
		if($id)
		{
			Vehicle::destory($id);
			return array('code'=>1, 'message'=>'数据删除成功');
		}

		return array('code'=> -1, 'message'=> '缺少参数id');
	}


}