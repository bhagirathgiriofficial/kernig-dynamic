<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFaq extends FormRequest
{/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        if ( is_null(request('id')) ){
            return [
                'faq_question'   => 'required|unique:faqs,faq_question,NULL,faq_id',
                'faq_answer'     => 'required',   
            ];
        } else {
            $id = request('id');
            return [
                 'faq_question'   => 'required|unique:faqs,faq_question,NULL,id,faq_question,'.$id,
                 'faq_answer'     => 'required',
            ];
        }
    }
}
