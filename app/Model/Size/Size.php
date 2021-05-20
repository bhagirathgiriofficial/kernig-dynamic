<?php

namespace App\model\Size;

use Illuminate\Database\Eloquent\Model;


/*

 * Size Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class Size extends Model
{
    protected $table = "sizes";
    protected $primaryKey = "size_id";
    protected $fillable = [
    	'size_measure',
    	'size_order',
    	'price_percent',
    ];
}
