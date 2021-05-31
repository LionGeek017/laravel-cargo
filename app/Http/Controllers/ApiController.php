<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Cargo;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * Show Contacts Car
     */
    public function contactCar(Request $request) {
        $car = Car::select('contact_name', 'contact_phone')
            ->where('id', $request->id)
            ->where('car_code', $request->code)
            ->first();
        if(!auth()->user() || auth()->user()->cannot('contacts', $car)) {
            $result = ['result' => 'subscribe'];
            return response()->json($result);
        }
        if($car) {
            $result = ['result' => 'ok', 'name' => $car->contact_name, 'phone' => $car->contact_phone];
            return response()->json($result);
        } else {
            return false;
        }
    }

    /**
     * Show Contacts Cargo
     */
    public function contactCargo(Request $request) {
        $cargo = Cargo::select('contact_name', 'contact_phone')
            ->where('id', $request->id)
            ->where('cargo_code', $request->code)
            ->first();
        //!Auth::id()
        if(!auth()->user() || auth()->user()->cannot('contacts', $cargo)) {
            $result = ['result' => 'subscribe'];
            return response()->json($result);
        }

        if($cargo) {
            $result = ['result' => 'ok', 'name' => $cargo->contact_name, 'phone' => $cargo->contact_phone];
            return response()->json($result);
        } else {
            return false;
        }

    }

    /**
     *
     */
    public static function apiCountry() {
        $countries = Country::select('id', 'name', 'vk_id')->get();
        return response()->json($countries);
    }

    /**
     *
     */
    public static function apiRegion() {
        $countryId = request()->country_id;
        $country = Region::select('id', 'country_id', 'name', 'vk_id')
            ->where('country_id', $countryId)
            ->orderBy('name')
            ->get();
        return response()->json($country);
        //return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     *
     */
    public static function apiCity(Request $request) {
        $cities = City::select('id', 'country_id', 'region_id', 'name', 'vk_id')
            ->where('country_id', $request->country_id)
            ->where('region_id', $request->region_id)
            ->orderBy('name')
            ->get();
        return response()->json($cities);
    }
}
