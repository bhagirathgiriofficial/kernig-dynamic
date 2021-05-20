<?php

namespace App\Model\Country;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   protected $table       = "countries";
   protected $primaryKey  = "country_id";
   protected $fillable = [
    	 'country_name',
    ];
    function shipping()
    {
    	return $this->hasMany('App\Model\Shipping\Shipping', 'shipping_country_id');
    }
}
 