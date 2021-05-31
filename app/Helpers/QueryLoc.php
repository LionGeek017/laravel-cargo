<?php
use Illuminate\Support\Facades\Http;

function queryLoc($params) {
    $urlLoc = 'https://nominatim.openstreetmap.org/search?q=' . $params . '&format=json';
    return Http::get($urlLoc)->object();
}
