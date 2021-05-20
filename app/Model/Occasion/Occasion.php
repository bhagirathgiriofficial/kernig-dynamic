<?php

namespace App\model\Occasion;

use Illuminate\Database\Eloquent\Model; 
use Cviebrock\EloquentSluggable\Sluggable;

/*

 * Occasion Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/

class Occasion extends Model
{
	use Sluggable;
   protected $table = "occasions";
   protected $primaryKey = "occasion_id";
   protected $fillable = [
   	 'occasion_name',
   ];

   /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'occasion_slug' => [
                'source' => ['occasion_name'],
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ],
        ];
    }

}
  