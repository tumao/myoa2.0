<?php namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Admin\ABaseController;
use App\Menu_catelogue;

class MenuController extends ABaseController {


	private $_menu_son_arr= array();
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return \Redirect::to('admin/conf/menu');
	}


	/**
	 *	页面展示
	 *
	 * @return Response
	 */
	public function show()
	{
		//
		$menuList = Menu_catelogue::all();
		return view('default.conf.menu.menu')->with('menuList', $menuList);
	}

	public function addMenuForm($id = '')
	{
		if($id !='')
		{
			$menu = Menu_catelogue::find($id);
		}
		else
		{
			$menu = array
				(
					'name'	=> '',
					'icon'	=> '',
					'sort'	=> '',
					'path'	=> ''
				);
		}

		return \View::make('default.conf.menu.menuForm')->with('menu', $menu);
	}

	public function saveMenuForm()
	{
		$vali = array('name', 'icon', 'path', 'root', 'sort');
		$menuArr = \Input::only($vali);
		if($menuArr['name'] == '')
		{
			return array('message'=> '菜单名不可以为空!', 'code' => -1);
		}
		elseif($menuArr['path'] == '')
		{
			return array('message'=> '路径不可以为空!', 'code' => -2);
		}
		$menu = Menu_catelogue::create($menuArr);
		if($menu)
		{
			return array('message'=> '插入成功!', 'code'=>1);
		}
		return array('message'=>'插入失败!', 'code'=>-3);
	}

	public function editMenuItem()
	{
		$vali = array('id','name', 'icon', 'path', 'sort');
		$menuArr = \Input::only($vali);
		$id = $menuArr['id'];
		unset($menuArr['id']);
		\DB::table('menu_catelogue')->where('id',$id)->update($menuArr);
		return array('message'=>'数据更新成功！', 'code'=>1);
	}

	public function delMenuItem($id='')
	{
		if($id == '')
		{
			return array('message'=>'缺少删除参数!', 'code' => -1);
		}
		$menu = Menu_catelogue::all();
		$this->_init_son_arr($menu, $id);
		array_push($this->_menu_son_arr, $id);
		$affectRow = Menu_catelogue::destroy($this->_menu_son_arr);
		if($affectRow)
		{
			return array('info' => $this->_menu_son_arr,'message'=>'删除成功!', 'code'=>1);
		}
	}

	private function _init_son_arr($list, $rid)
	{
		$condition = array();
		$child = $this->_find_children($list, $rid);
		$condition[] = $child;
		if(empty($child))
		{
			return NULL;
		}
		foreach($child as $k => $v)
		{
			$res = $this->_init_son_arr($list, $v['id']);
			if($res != NULL)
			{
				array_push($condition, $res);
				// $condition[] = $res;
			}
		}
		return $condition;
	}

	private function _find_children($list, $rid)
	{
		$child = array();
		foreach($list as & $x)
		{
			if($x['root'] == $rid)
			{
				$child[] = $x;
				array_push($this->_menu_son_arr, $x['id']);
			}
		}

		return $child;
	}



}
