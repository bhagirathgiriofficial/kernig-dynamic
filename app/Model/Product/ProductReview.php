<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{

    protected $table      = 'product_reviews';
    protected $primaryKey = 'product_review_id';

    function product()
    {
    	return $this->belongsTo('App\Model\Product\Product', 'product_id');
    }

}
