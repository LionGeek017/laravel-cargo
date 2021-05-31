<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id_from',
        'region_id_from',
        'city_id_from',
        'country_id_to',
        'region_id_to',
        'city_id_to',
        'cargo_name',
        'car_weight_id',
        'car_body_id',
        'price',
        'currency_id',
        'price_type_id',
        'pay_type_id',
        'contact_name',
        'contact_phone',
        'owner_type',
        'cargo_code',
        'user_id',
        'cargo_name_slug',
        'status',
        'date_valid'
    ];

    public static $ownerMin = [1 => 'Да', 2 => 'Нет'];
    public static $ownerMax = [1 => 'владелец', 2 => 'диспетчер'];
    public static $withRelations = [
        'countryFrom',
        'regionFrom',
        'cityFrom',
        'countryTo',
        'regionTo',
        'cityTo',
        'carWeight',
        'carBody',
        'currency',
        'priceType',
        'payType',
        'user'
    ];

//    public static function findOrFail(string $int)
//    {
//    }

    public function countryFrom() {
        return $this->belongsTo(Country::class, 'country_id_from');
    }

    public function regionFrom() {
        return $this->belongsTo(Region::class, 'region_id_from');
    }

    public function regionsFromCountryCargo() {
        return $this->hasMany(Region::class, 'country_id', 'country_id_from');
    }

    public function cityFrom() {
        return $this->belongsTo(City::class, 'city_id_from');
    }

    public function citiesFromRegionCargo() {
        return $this->hasMany(City::class, 'region_id', 'region_id_from');
    }

    public function countryTo() {
        return $this->belongsTo(Country::class, 'country_id_to');
    }

    public function regionTo() {
        return $this->belongsTo(Region::class, 'region_id_to');
    }

    public function regionsToCountryCargo() {
        return $this->hasMany(Region::class, 'country_id', 'country_id_to');
    }

    public function cityTo() {
        return $this->belongsTo(City::class, 'city_id_to');
    }

    public function citiesToRegionCargo() {
        return $this->hasMany(City::class, 'region_id', 'region_id_to');
    }

    public function carWeight() {
        return $this->belongsTo(CarWeight::class, 'car_weight_id');
    }

    public function carBody() {
        return $this->belongsTo(CarBody::class, 'car_body_id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function priceType() {
        return $this->belongsTo(PriceType::class, 'price_type_id');
    }

    public function payType() {
        return $this->belongsTo(PayType::class, 'pay_type_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function checkActual() {
        $cargos = Cargo::select('id', 'date_valid')->where('status', 1)->get();
        foreach ($cargos as $cargo) {
            if(!Functions::actualPublication($cargo->date_valid)) {
                $cargo->update(['status' => 0]);
            }
        }
    }
}
