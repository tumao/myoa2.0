<?php namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Menu_catelogue;

abstract class BaseController extends Controller
{
	public function __construct()
	{
		\View::addNamespace('website',realpath(base_path('resources/views/website/default')));

		if( \Route::currentRouteName() != 'login')
		{
			$this->_do_system_page_init();
		}
	}


	/**
	 * 初始化页面
	 *
	 * @return void
	 */
	private function _do_system_page_init()
	{
		$menu = Menu_catelogue::where('cat','=','front')->get();		//从数据库中输出所有菜单项
		$menu = $this->_find_main_menu($menu);
		// var_dump( $menu);exit;
		\View::share('menu', $menu);			//将数据分享到视图
	}

	/**
	 * 查找主菜单
	 * @param list 所有菜单项
	 *
	 * @return menu 包括 main_menu,sub_menu
	 */
	protected function _find_main_menu($list)
	{
		$navbar = $this->navbar($list);
		$main_menu = array();
		$sub_menu = array();
		foreach ($list as $x)
		{
			if( $x->root == 0)
			{
				$item['name'] = $x->name;
				$item['icon'] = $x->icon;
				$item['path'] = $x->path;
				if($this->_find_uri_curr($x->path))
				{
					$item['active'] = true;
					$sub_menu = $this->_init_menu_tree($list, $x->id);
				}
				else
				{
					$item['active'] = false;
				}
				array_push($main_menu, $item);
			}
		}
		$user = false;
		if(\Sentry::check())
		{
			$user = \Sentry::getUser();
		}
		$menu['main_menu'] = $main_menu;
		$menu['sub_menu'] = $sub_menu;
		$menu['navbar'] = $navbar;
		$menu['user'] = $user;
		return $menu;
	}

	/**
	*	生成菜单树
	*
	*
	**/
	protected function _init_menu_tree($list, $rid)
	{
		$child = $this->find_child_menu($list, $rid);
		if(empty( $child))
		{
			return NULL;
		}
		foreach($child as $k=>$v)
		{
			$res = $this->_init_menu_tree($list, $v['id']);
			if($res != NULL)
			{
				$child[$k]['children'] = $res;
			}
			else
			{
				$child[$k]['children'] = '';
			}
		}
		return $child;

	}

	private function find_child_menu($arr, $rid)
	{
		$child = array();
		foreach($arr as & $x)
		{
			if($x['root'] == $rid)
			{
				$child[] = $x;
				if($this->_find_uri_curr($x->path))
				{
					$x['active'] = true;
				}
				else
				{
					$x['active'] = false;
				}
			}
		}
		return $child;
	}

	/**
	 * 查看次单项是否为选中状态
	 * @param uri
	 *
	 * @return true|false
	 */
	private function _find_uri_curr($uri)
	{
		$uriformat = preg_replace('/(\/)+/iu', '/', $_SERVER['REQUEST_URI'].'/');
		$uri	= preg_replace('/(\/)+/iu', '/', $uri.'/');
		return strstr($uriformat, $uri) !== false;
	}

	private function navbar($list)
	{
		$navbar = array();
		foreach($list as $item)
		{
			if($this->_find_uri_curr($item->path))
			{
				$navbar[] = $item;
			}
		}
		return $navbar;
	}


}