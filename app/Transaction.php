<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'gateway_response' => 'array',
    ];

    /**
     * The education that belong to the course.
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    /**
     * The education that belong to the user.
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
