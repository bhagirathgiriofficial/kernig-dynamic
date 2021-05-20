<?php

namespace App\Model\Testimonial;

use Illuminate\Database\Eloquent\Model;


/*

 * Testimonial Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/

class Testimonial extends Model
{
    protected $table      = 'testimonials';
    protected $primaryKey = 'testimonial_id';
    protected $fillable   = [
    	'testimonial_name',
    	'testimonial_message',
    	'testimonial_place',
    	'testimonial_image',
    	'testimonial_order',
        'testimonial_homepage',
    	'testimonial_status',
    ];

}
