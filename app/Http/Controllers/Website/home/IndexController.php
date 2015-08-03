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
		return view('website::home.home');
	}

}