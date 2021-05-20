<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/*

 * Product Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class ProductCategory extends Model
{
    use SoftDeletes;

    protected $table      = 'product_category';
    protected $primaryKey = 'id';

    // Main category
    function parentCategory()
    {
        return $this->belongsTo('App\Model\Category\Category', 'category_root_id');
    }

    // Sub Category
    function subCategory()
    {
        return $this->belongsTo('App\Model\Category\Category', 'category_subroot_id');
    }

    // Category
    function category()
    {
        return $this->belongsTo('App\Model\Category\Category', 'category_id');
    }
}
