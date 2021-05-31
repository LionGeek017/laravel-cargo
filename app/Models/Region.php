<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    public static $withRelations = [
        'country',
        'cities'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
    public function cities() {
        return $this->hasMany(City::class);
    }










    public static function regionsCountry($countryId) {
        return Region::select('id', 'name')->where('country_id', $countryId)->orderBy('name')->get();
    }
}
