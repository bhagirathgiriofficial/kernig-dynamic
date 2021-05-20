<?php

namespace App\Model\Category;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;


/*

 * Category Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020

*/


class Category extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $table      = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable =
    [
        'category_name',
        'category_order',
        'category_root_id',
        'category_image',
        'size_chart',
        'category_desc',
        'category_status',
        'category_subroot_id',
        'category_meta_title',
        'category_meta_keywords',
        'category_meta_description',
    ];

    function getProduct()
    {
        return $this->hasMany('App\Model\Product\Product', 'category_id');
    }
    function parent_cat()
    {
        return $this->belongsTo('App\Model\Category\Category', 'category_root_id');
    }

    function sub_category()
    {
        return $this->belongsTo('App\Model\Category\Category', 'category_subroot_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'category_slug' => [
                'source' => ['category_name'],
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ],
        ];
    }

    // SB 3 March 2020
    function subCategories()
    {
        return $this->hasMany('App\Model\Category\Category', 'category_root_id')->where('category_status', 1);
    }

    // SB 3 march 2020
    function subSubCategories()
    {
        return $this->hasMany('App\Model\Category\Category', 'category_subroot_id')->where('category_status', 1);
    }

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
}
