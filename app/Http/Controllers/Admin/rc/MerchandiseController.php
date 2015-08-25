<?php namespace App\Http\Controllers\Admin\Resource;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ABaseController;

use Illuminate\Http\Request;

class MerchandiseController extends ABaseController
{

	//
	public function index()
	{

	}

	public function lists()
	{
		$mer = \DB::table('merchandise')
				->orderBy('id','desc')
				->get();
		return view('default.rc.merchandise.lists')->with('lists', $mer);
	}

	public function add()
	{

	}

	public function edit()
	{

	}

}
