<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'order';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $fillable = array('name', 'permissions', 'created_at', 'updated_at');

	/*
	 *	statusId --订单状态的id
	 */
	public function getOrderStatus($statusId)
	{
		$status = \DB::table('order_status')->where('id', '=', $statusId)->first();	//订单的状态
		return $status; 
	}

}