<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRole extends FormRequest
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
                'name'        => 'required|unique:roles,name,NULL,id,deleted_at,NULL,guard_name,NULL',
                'permissions' => 'required',
            ];
        } else {
            $id = dv(request('id'));
            return [
                'name'        => 'required|unique:roles,name,NULL,id,deleted_at,NULL,name,'.$id,
                'permissions' => 'required',
            ];
        }
    }
}
