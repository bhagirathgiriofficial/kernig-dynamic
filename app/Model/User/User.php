<?php

namespace App\Model\User;

use App\Notifications\CustomerResetPasswordNotification;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{

    use HasApiTokens, Notifiable;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'mobile_number',
        'address',
        'city',
        'state',
        'country_id',
        'email_verified_at',
        'password',
        'user_status',
    ];
    function country()
    {
        return $this->belongsTo('App\Model\Country\Country', 'country_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }
}
