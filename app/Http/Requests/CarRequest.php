<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'country_id' => 'required|regex:/[1-9,]/',
            'region_id' => 'required|regex:/[1-9,]/',
            'city_id' => 'required|regex:/[1-9,]/',
            'contact_name' => 'required|min:3|max:255',
            'contact_phone' => 'required|regex:/[0-9 -+]/|max:17',
            'car_body_id' => 'required|regex:/[1-9,]/',
            'car_weight_id' => 'required|regex:/[1-9,]/',
            'is_owner' => 'sometimes|accepted',
            'is_loc_agree' => 'sometimes|accepted',
            'available' => 'sometimes|accepted',
        ];
    }
}
