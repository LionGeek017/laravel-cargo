<?php

namespace App\Jobs;

use App\Models\City;
use App\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CityLoading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $regions;
    protected $country;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($regionArr, Country $country)
    {
        $this->regions = $regionArr;
        $this->country = $country;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $countryVkId = $this->country->vk_id;
        $countryId = $this->country->id;
        $offset = 0;

        foreach ($this->regions as $region) {
            $response = $this->responseUrl($region['vk_id'], $countryVkId, $offset = 0);
            $cities = City::where('region_id', $region['region_id'])->get();

            if($cities->count() > 0) {
                $city = false;
                foreach ($response['response']['items'] as $valCity) {
                    foreach ($cities as $val) {
                        if(trim($valCity['id']) == trim($val->vk_id)) {
                            $city = true;
                            break;
                        }
                    }
                    if(!$city)
                        $this->newCity($countryId, $region['region_id'], $valCity);
                    $city = false;
                }
            } else {
                foreach ($response['response']['items'] as $valCity) {
                    $this->newCity($countryId, $region['region_id'], $valCity);
                }
            }
        }
    }

    public function responseUrl($regionVkId, $countryVkId, $offset = 0) {
        $url = 'https://api.vk.com/method/database.getCities?region_id='.$regionVkId.'&country_id='.$countryVkId.'&access_token=58893bdb58893bdb58893bdbac58e351e75588958893bdb04594931f045e78a4b275410&v=5.126&need_all=1&offset='.$offset.'&count=1000&lang=ru';
        $response = Http::get($url);
        return $response->json();
    }

    public function newCity($countryId, $regionId, $response) {
        $city = new City();
        $city->country_id = $countryId;
        $city->region_id = $regionId;
        $city->name = $response['title'];
        $city->area = array_key_exists('area', $response) ? $response['area'] : '';
        $city->vk_id = $response['id'];
        $city->save();
        return true;
    }
}
