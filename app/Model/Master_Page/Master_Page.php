<?php

namespace App\Model\Master_Page;

use Illuminate\Database\Eloquent\Model;

/*

 * Master Page Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/

class Master_Page extends Model
{
	protected $table      = 'master_pages';
	protected $primaryKey = 'page_id';
	protected $fillable = [
		'page_name',
		'image_name',
		'page_small_description',
		'page_middle_description',
		'page_meta_title',
		'page_meta_keyword',
		'page_meta_description',
		'page_status',
	];
}
