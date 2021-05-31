<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public static $withRelations = [
        'country',
        'region'
    ];
    protected $fillable = [
        'country_id',
        'region_id',
        'name',
        'loc_lat',
        'loc_lng',
        'area',
        'vk_id'
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }
    public function region() {
        return $this->belongsTo(Region::class);
    }














    public static function citiesRegion($regionId) {
        return City::select('id', 'name')->where('region_id', $regionId)->orderBy('name')->get();
    }
}
