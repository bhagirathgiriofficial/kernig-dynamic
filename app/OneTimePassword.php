<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OneTimePassword extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'one_time_password',
        'request_token',
        'type',
        'expires_at',
    ];

    /**
     * Get the user that owns the one time password.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
