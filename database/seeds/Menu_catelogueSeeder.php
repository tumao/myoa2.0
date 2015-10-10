<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Menu_catelogue;

class Menu_catelogueSeeder extends Seeder{
	// 数据填充
	public function run()
	{
		Menu_catelogue::create(array(
			'name'	=> '仪表盘',
			'root'	=> 0,
			'sort'	=> 1,
			'path'	=> '/admin/dashboard',
			));
		Menu_catelogue::create(array(
			'name'	=> '用户',
			'root'	=> 0,
			'sort'	=> 1,
			'path'	=> '/admin/user',
			));
		Menu_catelogue::create(array(
			'name'	=> '资源',
			'root'	=> 0,
			'sort'	=> 1,
			'path'	=> '/admin/rc',
			));
		Menu_catelogue::create(array(
			'name'	=> '配置',
			'root'	=> 0,
			'sort'	=> 1,
			'path'	=> '/admin/conf',
			));
		Menu_catelogue::create(array(
			'name'	=> 'CNZZ统计',
			'root'	=> 1,
			'sort'	=> 1,
			'path'	=> '/admin/dashboard/census',
			));
		Menu_catelogue::create(array(
			'name'	=> '系统信息',
			'root'	=> 1,
			'sort'	=> 1,
			'path'	=> '/admin/dashboard/sys',
			));
		Menu_catelogue::create(array(
			'name'	=> '数据备份',
			'root'	=> 1,
			'sort'	=> 1,
			'path'	=> '/admin/dashboard/index',
			));
		Menu_catelogue::create(array(
			'name'	=> '清除缓存',
			'root'	=> 1,
			'sort'	=> 1,
			'path'	=> '/admin/dashbord/cleancache',
			));

		Menu_catelogue::create(array(
			'name'	=> '用户管理',
			'root'	=> 2,
			'sort'	=> 1,
			'path'	=> '/admin/user/userconf',
			));

		Menu_catelogue::create(array(
			'name'	=> '用户组管理',
			'root'	=> 2,
			'sort'	=> 1,
			'path'	=> '/admin/user/groups',
			));
		Menu_catelogue::create(array(
			'name'	=> '权限管理',
			'root'	=> 2,
			'sort'	=> 1,
			'path'	=> '/admin/user/permissions',
			));
		Menu_catelogue::create(array(
			'name'	=> '个人信息',
			'root'	=> 2,
			'sort'	=> 1,
			'path'	=> '/admin/user/self',
			));

		Menu_catelogue::create(array(
			'name'	=> 'Windows',
			'root'	=> 3,
			'sort'	=> 1,
			'path'	=> '/admin/rc/windows',
			));
		Menu_catelogue::create(array(
			'name'	=> 'Mac',
			'root'	=> 3,
			'sort'	=> 1,
			'path'	=> '/admin/rc/mac',
			));
		Menu_catelogue::create(array(
			'name'	=> '菜单管理',
			'root'	=> 4,
			'sort'	=> 1,
			'path'	=> '/admin',
			));
	}
}