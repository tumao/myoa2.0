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

}
