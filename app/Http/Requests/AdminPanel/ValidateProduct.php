<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProduct extends FormRequest
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
                'product_name'         => 'required',
                'product_description'  => 'max:3000',
            ];
        } else {
            $id = dv(request('id'));
            return [
                'product_name'   => 'required',
                'product_description'  => 'max:3000',
            ];
        }
    }
}
