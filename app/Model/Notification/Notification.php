<?php

namespace App\Model\Notification;

use Illuminate\Database\Eloquent\Model;

/*

 * Notification Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/
class Notification extends Model
{
    protected $table      = 'notifications';
    protected $primaryKey = 'notification_id';
}
