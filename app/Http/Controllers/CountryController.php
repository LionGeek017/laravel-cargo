<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Region;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class CountryController extends Controller
{


    public function index() {
        $countries = Country::all();
        return view('country.index', compact('countries'));
    }

    public function addCountry($vkId) {
        set_time_limit(0);

        $countries = Country::where('vk_id', $vkId)->first();

        if($countries) {
            $countryId = $countries->id;
        } else {
            $countryId = self::newCountry($vkId);
        }

        $regions = Region::where('country_id', $countryId)->get();
        if(count($regions) == 0) {
            $regionsId = self::apiRegion($vkId, $countryId);
        } else {
            $regionsId = self::apiRegion($vkId, $countryId, $regions);
        }

        self::apiCity($vkId, $countryId, $regionsId);
        return view('country.index');
    }

    public static function newCountry($vkId) {

        $country = new Country();
        $country->name = Country::$countriesData[$vkId]['name'];
        $country->code = Country::$countriesData[$vkId]['code'];
        $country->vk_id = $vkId;
        $country->status_from = 0;
        $country->active = 0;
        $country->save();

        return $country->id;
    }

    public static function apiRegion($countryVkId, $countryId, $regions = false) {
        $lang = 'ru';
        $count = 1000;
        $regionsId = [];
        $url = 'https://api.vk.com/method/database.getRegions?country_id='.$countryVkId.'&access_token=58893bdb58893bdb58893bdbac58e351e75588958893bdb04594931f045e78a4b275410&v=5.126&need_all=1&count='.$count.'&lang='.$lang;

        $response = Http::get($url);
        $response->json();

        if($regions) {
            $region = false;
            foreach ($response['response']['items'] as $valRegion) {
                foreach ($regions as $val) {
                    if($valRegion['id'] == $val['vk_id']) {
                        $region = true;
                        $regionsId[] = ['region_id' => $val['id'], 'region_vk_id' => $val['vk_id']];
                        break;
                    }
                }
                if(!$region)
                    $regionsId[] = self::newRegion($countryId, $valRegion);
                $region = false;
            }
        } else {
            foreach ($response['response']['items'] as $valRegion) {
                $regionsId[] = self::newRegion($countryId, $valRegion);
            }
        }
        return $regionsId;
    }

    public static function newRegion($countryId, $response) {
        $region = new Region();
        $region->country_id = $countryId;
        $region->name = $response['title'];
        $region->vk_id = $response['id'];
        $region->save();
        return ['region_id' => $region->id, 'region_vk_id' => $region->vk_id];
    }

    public static function apiCity($countryVkId, $countryId, $regionsId, $cities = false) {
        $lang = 'ru';
        $count = 1000;
        $cities_id = [];

        foreach ($regionsId as $val) {
            $url = 'https://api.vk.com/method/database.getCities?region_id='.$val['region_vk_id'].'&country_id='.$countryVkId.'&access_token=58893bdb58893bdb58893bdbac58e351e75588958893bdb04594931f045e78a4b275410&v=5.126&need_all=1&count='.$count.'&lang='.$lang;
            $response = Http::get($url);
            $response->json();

            $cities = City::where('region_id', $val['region_id'])->get();

            if(count($cities) > 0) {
                $city = false;
                foreach ($response['response']['items'] as $valCity) {
                    foreach ($cities as $val) {
                        if(trim($valCity['id']) == trim($val['vk_id'])) {
                            $city = true;
                            break;
                        }
                    }
                    if(!$city)
                        self::newCity($countryId, $val['region_id'], $valCity);
                    $city = false;
                }
            } else {
                foreach ($response['response']['items'] as $valCity) {
                    self::newCity($countryId, $val['region_id'], $valCity);
                }
            }
        }
    }

    public static function newCity($countryId, $regionId, $response) {
        $city = new City();
        $city->country_id = $countryId;
        $city->region_id = $regionId;
        $city->name = $response['title'];
        $city->area = $response['area'];
        $city->vk_id = $response['id'];
        $city->save();
        return true;
    }


}
