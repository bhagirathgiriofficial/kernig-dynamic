<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/*

 * Product Image Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/

class ProductImage extends Model
{
	use SoftDeletes;

    protected $table      = 'product_images';
    protected $primaryKey = 'product_image_id';

    function product()
    {
        return $this->belongsTo('app\Model\Product\Product', 'product_id');
    }

}
