<?php

namespace App\Model\Banner;

use Illuminate\Database\Eloquent\Model;

/*

 * Banner Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class Banner extends Model
{
    protected $table      = 'banners';
    protected $primaryKey = 'banner_id';


    function category()
    {
        return $this->belongsTo('App\Model\Category\Category', 'category_id');
    }

}
