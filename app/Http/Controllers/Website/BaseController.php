<?php namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
	public function __construct()
	{
		\View::addNamespace('website',realpath(base_path('resources/views/website/default')));
	}
}