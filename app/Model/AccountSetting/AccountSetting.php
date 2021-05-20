<?php

namespace App\Model\AccountSetting;

use Illuminate\Database\Eloquent\Model;

class AccountSetting extends Model
{
    protected $table      = "account_setting";
    protected $primaryKey = "account_setting_id";
    /* protected $fillable   = [
    	'site_name',
    	'site_email',
    	'site_sales_email',
    	'site_number',
    	'site_logo',
    	'site_address',
    	'facebook_url',
    	'twitter_url',
    	'instagram_url',
    	'googleplus_url',
    	'pinterest_url',
    ];*/
}
