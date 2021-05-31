<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'keywords',
        'description',
        'img',
        'slogan_top',
        'seo_main',
        'seo_cargo',
        'seo_car'
    ];
}
