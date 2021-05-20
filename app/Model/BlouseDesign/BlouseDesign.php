<?php

namespace App\Model\BlouseDesign;

use Illuminate\Database\Eloquent\Model;

class BlouseDesign extends Model
{
	protected $table          = "blouse_designs";
	protected $primaryKey    = "blouse_design_id";
	protected $fillable       = [
								'blouse_design_name ',
								'blouse_design_image',
								'blouse_design_order',
								'blouse_design_order',
								];	
}
