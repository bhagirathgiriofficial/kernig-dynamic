<?php

namespace App\Model\Measurement;

use Illuminate\Database\Eloquent\Model;

/*

 * Saree Measurement Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class SareeMeasurement extends Model
{
    protected $table = "saree_measurements";
    protected $primaryKey = "saree_measurement_id";
    protected $fillable = [
    	'saree_measurement_title',
    	'saree_measurement_price',
    	'saree_custom_id',
    ];
}
