<?php

namespace App\Model\Enquiry;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
	protected $table      = "enquiries";
	protected $primaryKey = "enquiry_id";
	protected $fillable   = [
		'enquiry_first_name',
		'enquiry_last_name',
		'enquiry_email',
		'enquiry_phone',
		'enquiry_comment',
		'enquiry_status',
	];

}
