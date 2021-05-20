<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/*

 * Product Order Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/

class ProductOrder extends Model
{
    use SoftDeletes;
    
    protected $table      = 'product_orders';
    protected $primaryKey = 'product_order_id';

    function productOrderDetail()
    {
        return $this->hasMany('App\Model\Product\ProductOrderDetail', 'product_order_id');
    }
    
    function user()
    {
        return $this->belongsTo('App\Model\User\User', 'user_id');
    }

    function billingCountry()
    {
         return $this->belongsTo('App\Model\Country\Country', 'billing_country');
    }

    function shippingCountry()
    {
         return $this->belongsTo('App\Model\Country\Country', 'shipping_country');
    }
    function deliveryAreaInfo()
    {
        return $this->belongsTo('App\Model\Product\DeliveryArea', 'delivery_area_id');
    }

    function deliveryTimeSlotInfo()
    {
        return $this->belongsTo('App\Model\Product\DeliveryTimeSlot', 'delivery_time_slot_id');
    }

}
