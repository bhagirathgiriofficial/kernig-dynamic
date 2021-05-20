<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUser extends FormRequest
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
        $role = request('role_type');
        
        if ($role == config('constants.users.types.STUDENT.value')){

            if ( is_null(request('id')) ){
                return [
                    'name'      => 'required',
                    'email'     => 'required|unique:users',
                    'image'     => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
                    'franchise' => 'required',
                    'role'      => 'required',
                    'category'  => 'required',
                    'education' => 'required',
                ];
            } else {
                $id = dv(request('id'));
                return [
                    'name'      => 'required',
                    'email'     => 'required|unique:users,email,'.$id,
                    'image'     => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
                    'franchise' => 'required',
                    'role'      => 'required',
                    'category'  => 'required',
                    'education' => 'required',
                ];
            }
        } else {
            if ( is_null(request('id')) ){
                return [
                    'name'      => 'required',
                    'email'     => 'required|unique:users',
                    'image'     => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
                    'franchise' => 'required',
                    'role'      => 'required',
                ];
            } else {
                $id = dv(request('id'));
                return [
                    'name'      => 'required',
                    'email'     => 'required|unique:users,email,'.$id,
                    'image'     => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
                    'franchise' => 'required',
                    'role'      => 'required',
                ];
            }
        }
    }
}
