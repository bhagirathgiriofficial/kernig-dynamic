<?php

namespace App\Model\Coupon;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
 	protected $table = "coupons";
 	protected $primaryKey = "coupon_id";
 	protected $fillable = [
 			'coupon_code',
 			'discount',
			'start_price',
			'end_price',
			'start_date',
			'end_date'
 	];

}
 