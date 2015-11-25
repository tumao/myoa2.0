<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {

	//
	protected $table = 'vehicle';

	public $fillable = array(
							'from_area_id',
							'to_area_id',
							'driver_name',
							'phone',
							'plate_number',
							'vehicle_type',
							'vehicle_body_type',
							'vehicle_length',
							'vehicle_weight',
							'location_id',
							'info',
							'user_id',
							'create_time'
							);

	public $timestamps = false;

	// public function from($name)
	// {
	// 	$area = \DB::select("SELECT * FROM `area` WHERE `area` like %$name%");
	// 	return $area;
	// }

	// 获取搜索城市对应的id
	public function provincesIds($name)
	{
		$ids = array();
		$provinces = \DB::select("SELECT * FROM `province` WHERE `province` LIKE '%".$name."%'");
		if(empty( $provinces))
		{
			return FALSE;
		}
		foreach($provinces as $item)
		{
			$ids[] = $item->provinceID;
		}
		return implode(',', $ids);
	}

	//
	public function cityIds($name, $provincesIds = '')
	{
		$ids = array();
		$where = '';
		$sql = "SELECT DISTINCT * FROM `city` WHERE `city` LIKE '%".$name."%'";
		if($provincesIds != '')
		{
			$where = " OR `father` IN ($provincesIds)";
			$sql .= $where;
		}
		$citys = \DB::select($sql);
		if(empty($citys))
		{
			return FALSE;
		}
		foreach($citys as $item)
		{
			$ids[] = $item->cityID;
		}
		return implode(',', $ids);
	}

	//
	public function areasID($name, $cityIds = '')
	{
		$ids = array();
		$where = '';
		$sql = "SELECT * FROM `area` WHERE `area` LIKE '%".$name."%'";
		if($cityIds != '')
		{
			$where = " OR `father` IN ($cityIds) ";
			$sql .= $where;
		}
		$areas = \DB::select($sql);
		if(empty($areas))
		{
			return FALSE;
		}
		foreach($areas as $item)
		{
			$ids[] = $item->areaID;
		}
		return implode(',', $ids);
	}

	public function search_area_ids($name)
	{
		$areas = $this->areasID($name);
		if($areas)
		{
			return $areas;
		}
		else
		{
			$citys = $this->cityIds($name);
			if( $citys)
			{
				$areas = $this->areasID($name, $citys);
				return $areas;
			}
			else
			{
				$provinces = $this->provincesIds($name);
				if($provinces)
				{
					$citys = $this->cityIds($name, $provinces);
					$areas = $this->areasID($name, $citys);
					return $areas;
				}
				else
				{
					return FALSE;
				}
			}
		}
	}

	//  from 为始发地 to 为终点
	public function search($from = '', $to = '', $vehicle_type ='', $vehicle_body_type = '', $vehicle_weight = '', $vehicle_length= '', $page = 1)
	{
		$from_ids = '';
		$to_ids = '';
		$page_limit = 5; // 每页显示的信息的条数
		if($from != '')
		{
			$from_ids = $this->search_area_ids($from);
		}
		if($to != '')
		{
			$to_ids = $this->search_area_ids($to);
		}
		$sql = "SELECT * FROM `vehicle` ";
		$where = " WHERE ";
		if($from_ids != '')
		{
			$where = $where . " `from_area_id` IN ($from_ids)";
		}
		else
		{
			$where .= " `from_area_id` <> '' ";
		}
		if($to_ids != '')
		{
			$where .= " AND `to_area_id` IN ($to_ids) ";
		}
		else
		{
			$where .= " AND `to_area_id` <> ''";
		}
		if($vehicle_type != '')
		{
			$where .= " AND `vehicle_type` =$vehicle_type ";
		}
		if($vehicle_body_type != '')
		{
			$where .= "  AND `vehicle_body_type` =$vehicle_body_type ";
		}
		if($vehicle_length != '')
		{
			$length = explode(',', $vehicle_length);
			if(count($length) == 1)
			{
				$where .= "  AND `vehicle_length` > {$length['0']} ";
			}
			else
			{
				$where .= "  AND `vehicle_length` BETWEEN {$length['0']} AND {$length['1']} ";
			}
		}
		if($vehicle_weight != '')
		{
			$length = explode(',', $vehicle_weight);
			if(count($length) == 1)
			{
				$where .= "  AND `vehicle_weight` > {$length['0']} ";
			}
			else
			{
				$where .= "  AND `vehicle_weight` BETWEEN {$length['0']} AND {$length['1']} ";
			}
		}
		$sql = $sql.$where;
		$vehicles = \DB::select($sql);
		$sum_pages = ceil(count($vehicles) / $page_limit);	//总页数
		if($page)
		{
			$offset = ($page - 1) * $page_limit;
			$limit = " ORDER BY id DESC LIMIT $offset, $page_limit ";
			$vehicles = \DB::select($sql.$limit);
		}
		$data['vehicles'] = $vehicles;
		$data['sum_page'] = $sum_pages;
		return $data;
	}

}
