<?php

namespace App\model\Accessories;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/*

 * Accessories Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/ 

class Accessories extends Model
{
	use Sluggable;

	protected $table      = "accessories";
	protected $primaryKey = "accessory_id";
	protected $fillable   = [
		'accessory_name',
		'accessory_price',
		'accessory_status',
		'accessory_slug'
	];

	/**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'accessory_slug' => [
                'source' => ['accessory_name'],
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ],
        ];
    }

}
