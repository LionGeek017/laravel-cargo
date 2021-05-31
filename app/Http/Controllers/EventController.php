<?php

namespace App\Http\Controllers;

use App\Events\SendCargoTG;
use App\Events\SendMail;
use App\Events\AccountLogin;
use App\Jobs\CargoReceiveCoordinates;
use App\Jobs\CarReceiveCoordinates;
use App\Jobs\CityLoading;
use App\Jobs\RegionLoading;
use App\Jobs\SendMessage;
use App\Models\Car;
use App\Models\Cargo;
use App\Models\Country;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public static function sendEmail($userId) {
        SendMessage::dispatch($userId); //->delay(now()->addMinutes(1));
        //Event::dispatch(new SendMail($userId));
    }

    public static function sendCargoTG(Cargo $cargo) {
        Event::dispatch(new SendCargoTG($cargo));
    }

    public static function cargoReceiveCoordinates(Cargo $cargo) {
        CargoReceiveCoordinates::dispatch($cargo);
    }

    public static function carReceiveCoordinates(Car $car) {
        CarReceiveCoordinates::dispatch($car);
    }

    public static function regionLoading(Country $country) {
        RegionLoading::dispatch($country);
    }

    public static function cityLoading($regionArr, Country $country) {
        CityLoading::dispatch($regionArr, $country);
    }
}
