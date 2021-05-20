<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Statusable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Http\Traits\HasSlug;
use App\Http\Traits\Orderable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\StatusToggleable;

class Course extends Model
{
    use SoftDeletes, Statusable, Sluggable, HasSlug, Orderable, StatusToggleable;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
