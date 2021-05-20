<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
        request()->merge(['is_change_password_form' => true]);

        return [
            'current_password'          => 'required',
            'new_password'              => 'required|different:current_password',
            'new_password_again'        => 'required|same:new_password'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'new_password_again.same'   => 'The new password and new confirm password are not the same.',
            'new_password.different'    => "New password can't be same as current password",
        ];
    }
}
