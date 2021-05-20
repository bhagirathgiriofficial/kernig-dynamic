<?php

namespace App\Model\AdminUser;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
 //   use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminPanel\RestPasswordNotification;

/*

 * Admin User Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/




class AdminUser extends Authenticatable
{

    use Notifiable;

    protected $table      = 'admin_users';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'name',
        'mobile_number',
        'image',
    ];

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        // protected $fillable = [
        //     'name', 'email', 'password',
        // ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        // protected $casts = [
        //     'email_verified_at' => 'datetime',
        // ];

        /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
        public function sendPasswordResetNotification($token)
        {
            $this->notify(new RestPasswordNotification($token));
        }

    }
    