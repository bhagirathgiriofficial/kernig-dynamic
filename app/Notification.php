<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The education that belong to the user.
     */
    public function notification_type()
    {
        return $this->belongsTo('App\NotificationType');
    }
}
