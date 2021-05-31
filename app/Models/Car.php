<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public static $ownerType = [0 => 'Диспетчер', 1 => 'Владелец'];
    public static $availableType = [0 => 'Занят', 1 => 'Свободен'];
    public static $arrWith = [
        'country',
        'region',
        'city',
        'carWeight',
        'carBody',
        'user'
    ];

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function region() {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function carWeight() {
        return $this->belongsTo(CarWeight::class, 'car_weight_id');
    }

    public function carBody() {
        return $this->belongsTo(CarBody::class, 'car_body_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function checkActual() {
        $cars = Car::select('id', 'date_valid')->where('available', 1)->get();
        foreach ($cars as $car) {
            if(!Functions::actualPublication($car->date_valid)) {
                $car->update(['available' => 0]);
            }
        }
    }
}
