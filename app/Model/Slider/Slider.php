<?php

namespace App\Model\Slider;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	protected $table = "slider";
	protected $primaryKey = "slider_id";
	protected $fillable = [
		'slider_title',
		'slider_image',
		'slider_link',
		'slider_status',
		'slider_description'
	];
}
