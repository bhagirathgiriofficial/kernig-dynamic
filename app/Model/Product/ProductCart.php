<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;


/*

 * Product Cart Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/

class ProductCart extends Model
{

    protected $table      = 'product_carts';
    protected $primaryKey = 'product_cart_id';

    function product()
    {
        return $this->belongsTo('App\Model\Product\Product', 'product_id');
    }
    function variant()
    {
        return $this->belongsTo('App\Model\Product\Variant', 'variant_id');
    }

}
