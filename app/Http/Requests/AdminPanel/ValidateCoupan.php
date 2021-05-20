<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCoupon extends FormRequest
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
                'coupon_code'   => 'required|unique:coupons,coupon_code,NULL,coupon_id',
                'start_date'    => 'required|date',
                'end_date'      => 'required|date|after_or_equal:start_date',
            ];
        } else {
            $id = request('id');
            return [
                 'coupon_code'   => 'required|unique:coupons,coupon_code,NULL,id,coupon_code,'.$id,
                 'start_date'    => 'required|date',
                 'end_date'      => 'required|date|after_or_equal:start_date',
            ];
        }
    }
}
