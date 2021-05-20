<?php

namespace App\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSalwarMeasurement extends FormRequest
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
		'measurement_title'   => 'required|unique:salwar_measurements,salwar_measurement_titles,NULL,id',
	];
} else {
	$id = dv(request('id'));
	return [
		'measurement_title'   => 'required|unique:salwar_measurements,salwar_measurement_titles,NULL,id,measurement_title,'.$id,
	];
}
}
}
