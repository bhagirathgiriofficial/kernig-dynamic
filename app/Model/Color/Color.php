<?php

namespace App\model\Color;


use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/*

 * Color Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/
class Color extends Model
{
	use Sluggable;
   	protected $table = "colors";
   	protected $primaryKey = "color_id";

   	protected $fillable = [
   		'color_name',
   		'color_status',
		'color_code',
   	];

   	/**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'color_slug' => [
                'source' => ['color_name'],
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ],
        ];
    }
}
