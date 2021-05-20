<?php

namespace App\Model\Product;
use Illuminate\Database\Eloquent\Model;

class ProductEnquiry extends Model
{
    protected $table      = 'product_enquiry';
    protected $primaryKey = 'product_enquiry_id';

    function product()
    {
    	return $this->belongsTo('App\Model\Product\Product', 'product_id');
    }
}
