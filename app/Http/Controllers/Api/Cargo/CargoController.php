<?php

namespace App\Http\Controllers\Api\Cargo;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function getCargo() {
        $query = Cargo::with(Cargo::$withRelations)
            ->where('status', 1)
            ->get();

        return response()->json([
            "success" => true,
            "data" => $query
        ], 200);
    }
}
