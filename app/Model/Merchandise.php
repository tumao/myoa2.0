<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model {

	//
	protected $table = 'merchandise';

	protected $fillable = array('from_area_id', 'to_area_id', 'merchandise_date', 'contact_name', 'phone', 'merchandise_name', 'merchandise_type','merchandise_shipping_method', 'merchandise_weight','merchandise_volume', 'merchandise_status', 'info', 'user_id', 'create_time');

	public $timestamps = false;

}
