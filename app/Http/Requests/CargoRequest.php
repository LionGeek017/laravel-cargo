<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id_from' => 'required|regex:/[1-9,]/',
            'region_id_from' => 'required|regex:/[1-9,]/',
            'city_id_from' => 'required|regex:/[1-9,]/',
            'country_id_to' => 'required|regex:/[1-9,]/',
            'region_id_to' => 'required|regex:/[1-9,]/',
            'city_id_to' => 'required|regex:/[1-9,]/',
            'cargo_name' => 'required|min:3|max:255',
            'car_weight_id' => 'required|regex:/[1-9,]/',
            'car_body_id' => 'required|regex:/[1-9,]/',
            'price' => 'required|integer',
            'currency_id' => 'required|regex:/[1-9,]/',
            'price_type_id' => 'required|regex:/[1-9,]/',
            'pay_type_id' => 'required|regex:/[1-9,]/',
            'contact_name' => 'required|min:3|max:255',
            'contact_phone' => 'required|regex:/[0-9 -+]/|max:17',
            'owner_type' => 'required|integer',
        ];
    }
}
