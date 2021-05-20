<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/*

 * Product Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class ProductFabric extends Model
{
	use SoftDeletes;

    protected $table      = 'product_fabric';
    protected $primaryKey = 'id';

}
