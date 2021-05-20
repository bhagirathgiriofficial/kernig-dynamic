<?php

namespace App\Model\Faq;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = "faqs";
    protected $primaryKey = "faq_id";
    protected $fillable = [
        'faq_question',
        'faq_answer',
        'faq_status'
    ];
}
