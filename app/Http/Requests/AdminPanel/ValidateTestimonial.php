<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateTestimonial extends FormRequest
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
               'testimonial_name'          => 'required',
                'testimonial_message'      => 'required',

                
            ];
        } else {
            $id = request('id');
            return [
               'testimonial_name'          => 'required',
                'testimonial_message'      => 'required',
               
                 
            ];
        }
    }
}
