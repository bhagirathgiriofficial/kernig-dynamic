<?php

namespace App;

use App\Http\Traits\HasSlug;
use App\Http\Traits\Statusable;
use App\Http\Traits\StatusToggleable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use Sluggable, Statusable, HasSlug, StatusToggleable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
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
                'source' => 'name',
                'onUpdate' => false,
                'unique' => true,
            ],
        ];
    }
}
