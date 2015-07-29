<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_catelogue extends Model {

	//
	protected $table = 'menu_catelogue';

	protected $fillable = array('name', 'icon', 'root', 'sort', 'path','group');

	public $timestamps = false;

	private $menuT = array();		//菜单列表

	private $menuG = array();		//菜单分组列表

	public function menuGroup()
	{
		// $sql = "SELECT * FROM `menu_catelogue` ORDER BY ?,? ASC";
		// $menuList = \DB::select($sql,['group','id']);
		$menuList = Menu_catelogue::all();
		// $this->_init_menu($menuList, 0);
		$this->sep_menu($menuList, 0);
		return $this->menuG;
		// exit(json_encode($this->menuG));
	}

	/**
	*	根据递归关系生成菜单列表
	*
	*
	*/
	public function _init_menu($menu, $rootId)
	{
		$child = $this->_find_child_menu($menu, $rootId);
		if(empty($child))
		{
			return NULL;
		}
		foreach($child as $k => $v)
		{
			$this->menuT[] = $v;
			$res = $this->_init_menu($menu, $v['id']);

		}
	}

	/**
	*	找到子菜单
	*
	*
	*/
	private function _find_child_menu($arr, $rid)
	{
		$child = array();
		foreach($arr as & $x)
		{
			if($x['root'] == $rid)
			{
				$child[] = $x;
			}
		}
		return $child;
	}

	/**
	 *	根据递归关系生成分组菜单
	 *
	 *
	 */
	private function sep_menu($menu, $rootId)
	{
		$this->_init_menu($menu, $rootId);
		$menu = $this->menuT;
		$menuGroup = & $this->menuG;
		$lastGroupId = 0;
		foreach($menu as $x )
		{
			$menuGroup[$x['group']][] = $x;
		}
	}
}
