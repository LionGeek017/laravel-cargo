<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Country extends Model
{
    use HasFactory;
    public static $status = [
        'отключена',
        'активна'
    ];

    public static $countriesData = [
        1 => [
            'name' => 'Россия',
            'code' => 'RU',
        ],
        2 => [
            'name' => 'Украина',
            'code' => 'UA',
        ],
        4 => [
            'name' => 'Казахстан',
            'code' => 'KZ',
        ]
    ];

    public static $withRelations = [
        'regions',
        'cities'
    ];

    public function regions() {
        return $this->hasMany(Region::class);
    }
    public function cities() {
        return $this->hasMany(City::class);
    }
}
