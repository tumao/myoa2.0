<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vehicle;

class Merchandise extends Model {

	//
	protected $table = 'merchandise';

	protected $fillable = array('from_area_id', 'to_area_id', 'merchandise_date', 'contact_name', 'phone', 'merchandise_name', 'merchandise_type','merchandise_shipping_method', 'merchandise_weight','merchandise_volume', 'merchandise_status', 'info', 'user_id', 'create_time');

	public $timestamps = false;

	public function search($from='', $to='', $merchandise_type='', $merchandise_shipping_method='', $page=1)
	{
		$vehicle = new Vehicle();

		$from_ids = '';
		$to_ids = '';
		$page_limit = 5;
		if($from != '')
		{
			$from_ids = $vehicle->search_area_ids($from);
		}
		if($to != '')
		{
			$to_ids = $vehicle->search_area_ids($to);
		}

		$sql = "SELECT * FROM `merchandise` ";
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
		if($merchandise_type != '')
		{
			$where .= " AND `merchandise_type` =$merchandise_type ";
		}
		if($merchandise_shipping_method != '')
		{
			$where .= "  AND `merchandise_shipping_method` =$merchandise_shipping_method ";
		}

		$sql = $sql.$where;
		$merchandise = \DB::select($sql);
		$sum_pages = ceil(count($merchandise) / $page_limit);	//总页数
		if($page)
		{
			$offset = ($page - 1) * $page_limit;
			$limit = " ORDER BY id DESC LIMIT $offset, $page_limit ";
			$merchandise = \DB::select($sql.$limit);
		}
		$data['mer'] = $merchandise;
		$data['sum_page'] = $sum_pages;
		return $data;
	}

}
