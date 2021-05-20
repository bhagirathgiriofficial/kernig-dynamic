<?php

namespace App\Model\Transaction;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/*

 * Transaction Model
 * @author : Sandeep
 * @created : 15 - April -2020 

*/
class Transaction extends Model
{
   	protected $table = "transactions";
   	protected $primaryKey = "transaction_id";

   	function user()
   	{
   		return $this->hasOne("App\Model\User\User", "id", "user_id");
   	}
   	function order()
   	{
   		return $this->belongsTo("App\Model\Product\ProductOrder","order_id");
   	}
}
