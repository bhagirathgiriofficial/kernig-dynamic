<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/*

 * Product Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020

*/


class Product extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $table      = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable   = [
        'product_code',
        'product_name',
        'product_slug',
        'product_type',
        'measurement_id',
        'product_price',
        'product_discounted_price',
        'product_discount_percent',
        'product_categories',
        'product_colors',
        'product_fabrics',
        'product_occasions',
        'product_sizes',
        'product_accessories',
        'product_weight',
        'product_timetoship',
        'product_description',
        'product_notes',
        'product_views',
        'product_image',
        'product_image_small',
        'product_status',
        'out_of_stock',
    ];
    // color
    function color()
    {
        return $this->hasMany('App\Model\Product\ProductColor', 'product_id');
    }
    // size
    function size()
    {
        return $this->hasMany('App\Model\Product\ProductSize', 'product_id');
    }
    // fabric
    function fabric()
    {
        return $this->hasMany('App\Model\Product\ProductFabric', 'product_id');
    }
    // Occasion
    function occasion()
    {
        return $this->hasMany('App\Model\Product\ProductOccasion', 'product_id');
    }
    // Accessories
    function accessory()
    {
        return $this->hasMany('App\Model\Product\ProductAccessories', 'product_id');
    }
    // Category
    function category()
    {
        return $this->hasMany('App\Model\Product\ProductCategory', 'product_id');
    }
    // Images
    function getImages()
    {
        return $this->hasMany('App\Model\Product\ProductImage', 'product_id');
    }
    function productCart()
    {
        return $this->hasOne('App\Model\Product\ProductCart', 'product_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'product_slug' => [
                'source' => ['product_name', 'product_code'],
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ],
        ];
    }

    function measurement()
    {
        return $this->belongsTo('App\Model\Measurement\Measurement', 'measurement_id');
    }

    // Product Reviews
    function productReviews()
    {
        return $this->hasMany('App\Model\Product\ProductReview', 'product_id');
    }

    // Product Category
    function productCategory()
    {
        return $this->hasMany('App\Model\Product\ProductCategory', 'product_id');
    }

    // Product Reviews Count
    function productReviewsCount()
    {
        return $this->hasMany('App\Model\Product\ProductReview', 'product_id');
    }
}
