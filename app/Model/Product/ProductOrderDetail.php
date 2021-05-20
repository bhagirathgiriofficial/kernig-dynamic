<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;


/*

 * Product Order Detail Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class ProductOrderDetail extends Model
{
    protected $table      = 'product_order_details';
    protected $primaryKey = 'product_order_detail_id';

    function productOrder()
    {
        return $this->belongsTo('App\Model\Product\ProductOrder', 'product_order_id');
    }
    function product()
    {
        return $this->belongsTo('App\Model\Product\Product', 'product_id');
    }

    function variant()
    {
        return $this->belongsTo('App\Model\Product\Variant', 'variant_id');
    }
}
