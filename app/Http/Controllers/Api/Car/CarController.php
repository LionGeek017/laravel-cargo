<?php

namespace App\Http\Controllers\Api\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function getCar() {
        $query = Car::with(Car::$arrWith)
            ->where('status', 1)
            ->get();

        return response()->json([
            "success" => true,
            "data" => $query
        ], 200);
    }
}
