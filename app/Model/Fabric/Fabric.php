<?php

namespace App\model\Fabric;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/*

 * Fabric Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/



class Fabric extends Model
{
	use Sluggable;
   protected $table       = "fabrics";
   protected $primaryKey  = "fabric_id";
   protected $fillable    = [
   	'fabric_name',
   	'fabric_order',
   	'fabric_status',
   ];

   /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'fabric_slug' => [
                'source' => ['fabric_name'],
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ],
        ];
    }

}
