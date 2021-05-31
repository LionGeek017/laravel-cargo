<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        return [
            'name' => 'required|min:3|max:255',
            'country_id' => 'required|integer|not_in:0',
            'region_id' => 'required|integer|not_in:0',
            'vk_id' => 'required|integer|not_in:0',
            'loc_lat' => 'required|numeric|not_in:0',
            'loc_lng' => 'required|numeric|not_in:0'
        ];
    }
}
