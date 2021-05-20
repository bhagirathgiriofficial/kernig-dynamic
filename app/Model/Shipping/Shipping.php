<?php

namespace App\Model\Shipping;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table      = "shipping_charges";
    protected $primaryKey = "shipping_id";
    protected $fillable = [
    	'shipping_country_id',
    	'shipping_weight',
    	'shipping_price',
        'shipping_status',
    ];
    function country()
    {
		return $this->belongsTo('App\Model\Country\Country','shipping_country_id');
    }
}
