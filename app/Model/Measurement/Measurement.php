<?php 

namespace App\Model\Measurement;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/*

 * Measurement Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class Measurement extends Model
{
    use Sluggable;

    protected $table = "measurements";
    protected $primaryKey = "measurement_id";
    protected $fillable = [
    	'measurement_title',
    	'measurement_price',
    	'measurement_desc',
        'measurement_slug',
    	'measurement_chart',

    ];
    function details()
    {
    	return $this->hasMany('App\Model\Measurement\MeasurementDetail', 'measurement_id');
    }

    /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'measurement_slug' => [
                'source' => ['measurement_title'],
                'separator' => '-',
                'onUpdate' => true,
                'unique' => true,
            ],
        ];
    }

}
