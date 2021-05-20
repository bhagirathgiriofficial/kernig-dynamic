<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSize extends FormRequest
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
                'size_name'   => 'required|unique:sizes,size_measure,NULL,id',
            ];
        } else {
            $id = dv(request('id'));
            return [
                'size_name'   => 'required|unique:sizes,size_measure,NULL,id,size_measure,'.$id,
            ];
        }
    }
}
