<?php

namespace App\Jobs;

use App\Http\Controllers\EventController;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class RegionLoading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $country;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($countryObject)
    {
        $this->country = $countryObject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $country = $this->country;
        //$regionItems = [];
        $regionsIds = [];
        $response = $this->responseUrl($country->vk_id);
        $regions = Region::where('country_id', $country->id)->get();
        if($regions->count() > 0) {
            $region = false;
            foreach ($response['response']['items'] as $valRegion) {
                foreach ($regions as $val) {
                    if($valRegion['id'] == $val->vk_id) {
                        $region = true;
                        $regionsIds[] = ['region_id' => $val->id, 'vk_id' => $val->vk_id];
                        break;
                    }
                }
                if(!$region)
                    $regionsIds[] = $this->newRegion($country->id, $valRegion);
                $region = false;
            }
        } else {
            foreach ($response['response']['items'] as $region) {
                $regionsIds[] = $this->newRegion($country->id, $region);
            }
        }
        EventController::cityLoading($regionsIds, $country);
    }

    public function responseUrl($countryVkId, $offset = 0) {
        $url = 'https://api.vk.com/method/database.getRegions?country_id='.$countryVkId.'&access_token=58893bdb58893bdb58893bdbac58e351e75588958893bdb04594931f045e78a4b275410&v=5.126&need_all=1&offset='.$offset.'&count=1000&lang=ru';
        $response = Http::get($url);
        return $response->json();
    }

    public function newRegion($countryId, $response) {
        $region = new Region();
        $region->country_id = $countryId;
        $region->name = $response['title'];
        $region->vk_id = $response['id'];
        $region->save();
        return ['region_id' => $region->id, 'vk_id' => $region->vk_id];
    }
}
