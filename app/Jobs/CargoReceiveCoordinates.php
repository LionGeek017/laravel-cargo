<?php

namespace App\Jobs;

use App\Models\Cargo;
use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CargoReceiveCoordinates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $cargo;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cargoObject)
    {
        $this->cargo = $cargoObject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$url = 'https://nominatim.openstreetmap.org/search?q=Николаев+николаевская+область&format=json';
        //http://router.project-osrm.org/route/v1/driving/32.00211658147113,46.932879549999996;31.3338636,47.5679582?overview=false
        $cargoRow = Cargo::with([
            'countryFrom',
            'regionFrom',
            'cityFrom',
            'countryTo',
            'regionTo',
            'cityTo'
        ])->find($this->cargo->id);

        if($cargoRow->cityFrom->loc_lat > 0 && $cargoRow->cityFrom->loc_lng > 0) {
            $locLatFrom = $cargoRow->cityFrom->loc_lat;
            $locLngFrom = $cargoRow->cityFrom->loc_lng;
        } else {
            $countryFromName = $cargoRow->countryFrom->name;
            $regionFromName = $cargoRow->regionFrom->name;
            $cityFromName = $cargoRow->cityFrom->name;

            $params = urlencode($cityFromName) . ',' . urlencode($regionFromName) . ',' . urlencode($countryFromName);
            $answerLocFrom = queryLoc($params);
            $locLatFrom = $answerLocFrom[0]->lat;
            $locLngFrom = $answerLocFrom[0]->lon;

            $cityUpdate = City::findOrFail($cargoRow->cityFrom->id);
            $cityUpdate->loc_lat = $locLatFrom;
            $cityUpdate->loc_lng = $locLngFrom;
            $cityUpdate->update();
        }

        if($cargoRow->cityTo->loc_lat > 0 && $cargoRow->cityTo->loc_lng > 0) {
            $locLatTo = $cargoRow->cityTo->loc_lat;
            $locLngTo = $cargoRow->cityTo->loc_lng;
        } else {
            $countryToName = $cargoRow->countryTo->name;
            $regionToName = $cargoRow->regionTo->name;
            $cityToName = $cargoRow->cityTo->name;

            $params = urlencode($cityToName) . ',' . urlencode($regionToName) . ',' . urlencode($countryToName);
            $answerLocTo = queryLoc($params);
            $locLatTo = $answerLocTo[0]->lat;
            $locLngTo = $answerLocTo[0]->lon;

            $cityUpdate = City::findOrFail($cargoRow->cityTo->id);
            $cityUpdate->loc_lat = $locLatTo;
            $cityUpdate->loc_lng = $locLngTo;
            $cityUpdate->update();
        }

        $urlDistance = 'http://router.project-osrm.org/route/v1/driving/' . $locLngFrom . ',' . $locLatFrom . ';' . $locLngTo . ',' . $locLatTo . '?overview=false';
        $answerDistance = Http::get($urlDistance)->object();

        $distance = ceil($answerDistance -> routes[0] -> distance / 1000);

        $cargoUpdate = Cargo::findOrFail($this->cargo->id);
        $cargoUpdate->loc_lat_from = $locLatFrom;
        $cargoUpdate->loc_lng_from = $locLngFrom;
        $cargoUpdate->loc_lat_to = $locLatTo;
        $cargoUpdate->loc_lng_to = $locLngTo;
        $cargoUpdate->distance = $distance;
        $cargoUpdate->update();
    }
}
