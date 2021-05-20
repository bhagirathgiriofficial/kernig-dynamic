<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePage extends FormReqsuest
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
                'page_long_description' => 'required',
            ];
        } else {
            $id = dv(request('id'));
            return [
                'page_long_description' => 'required',
            ];
        }
    }
}
