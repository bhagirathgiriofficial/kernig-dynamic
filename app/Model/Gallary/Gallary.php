<?php

namespace App\Model\Gallary;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $table       = "gallary";
    protected $primaryKey  = "image_id"; 
    protected $fillable    = [
		'image_title',
		'gallary_image',
		'image_desc',
    ];
}
