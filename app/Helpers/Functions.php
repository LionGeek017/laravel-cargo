<?php


namespace App\Helpers;
use App\Models\Car;
use App\Models\Cargo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;


class Functions
{
    // генерируем новый токен для защиты повторной отправки форм
    public static function regenerateToken() {
        Session::put('_token', sha1(microtime()));
    }

    // проверяем актуальность поста
    public static function actualPublication($dateValid) {
        $dt = Carbon::now();
        $dtSeconds = strtotime($dt);
        $dateValidSeconds = strtotime($dateValid);
        $resultSeconds = $dateValidSeconds - $dtSeconds;
        if($resultSeconds > 0) {
            return $dt->addSeconds($resultSeconds)->diffForHumans();
        }
        return null;
    }

    // Status cargo and car status user
    public static function statusCargoCar($userId) {
        $cargos = Cargo::where('user_id', $userId)->get();
        foreach ($cargos as $cargo) {
            $cargo->status = 0;
            $cargo->update();
        }
        $cars = Car::where('user_id', $userId)->get();
        foreach ($cars as $car) {
            $car->status = 0;
            $car->update();
        }
    }
}
