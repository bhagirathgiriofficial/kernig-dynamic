<?php 

namespace App\Model\Newsletter;

use Illuminate\Database\Eloquent\Model;

/*

 * Newsletter Model
 * @author : Bhagirath
 * @created : 05 - Feb -2020 

*/


class Newsletter extends Model
{
    protected $table = "news_letters";
    protected $primaryKey = "news_letter_id";

}
