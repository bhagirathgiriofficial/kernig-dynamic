<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSlider extends FormRequest
{
    /**
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
                'slider_title'   => 'required|unique:slider,slider_title,NULL,id',
            ];
        } else {
            $id = dv(request('id'));
            return [
                'slider_title'   => 'required|unique:slider,slider_title,NULL,id,slider_title,'.$id,
            ];
        }
    }
}
