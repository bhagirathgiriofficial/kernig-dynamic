<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;


/*

 * User Wish List Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class UserWhishList extends Model
{
    function wishlistProduct()
	{
		return $this->belongsTo('App\Model\Product\Product','product_id');
	}
}
