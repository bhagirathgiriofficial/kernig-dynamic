<?php

namespace App\Model\Measurement;

use Illuminate\Database\Eloquent\Model;


/*

 * Salwar Measurement Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class SalwarMeasurement extends Model
{
 	protected $table = "salwar_measurements";
 	protected $primaryKey = "salwar_measurement_id";
 	protected $fillable = [
 		'salwar_measurement_titles',
 		'salwar_measurement_price',
 		'salwar_measurement_chart',
 		'salwar_description',
 	];

 	function belong_to()
 	{
 		return $this->hasMany('App\Model\Measurement\SalwarMeasurement','belong_to');
 	}

 	function topMeasurement()
    {
    	return $this->hasMany('App\Model\Measurement\SalwarTop', 'salwar_measurement_id');
    }

    function bottomMeasurement()
    {
    	return $this->hasMany('App\Model\Measurement\SalwarBottom', 'salwar_measurement_id');
    }
}
