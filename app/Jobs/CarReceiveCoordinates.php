<?php

namespace App\Jobs;

use App\Models\Car;
use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CarReceiveCoordinates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $car;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($carObject)
    {
        $this->car = $carObject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $carRow = Car::with([
            'country',
            'region',
            'city'
        ])->find($this->car->id);

        if($carRow->city->loc_lat > 0 && $carRow->city->loc_lng > 0) {
            $locLat = $carRow->city->loc_lat;
            $locLng = $carRow->city->loc_lng;
        } else {
            $countryName = $carRow->country->name;
            $regionName = $carRow->region->name;
            $cityName = $carRow->city->name;
            $params = urlencode($cityName) . ',' . urlencode($regionName) . ',' . urlencode($countryName);

            //$answerLoc = Functions::queryLoc($params);
            $answerLoc = queryLoc($params);
            $locLat = $answerLoc[0]->lat;
            $locLng = $answerLoc[0]->lon;

            $cityUpdate = City::findOrFail($carRow->city->id);
            $cityUpdate->loc_lat = $locLat;
            $cityUpdate->loc_lng = $locLng;
            $cityUpdate->update();
        }

        $carUpdate = Car::findOrFail($this->car->id);
        $carUpdate->loc_lat = $locLat;
        $carUpdate->loc_lng = $locLng;
        $carUpdate->update();
    }
}
