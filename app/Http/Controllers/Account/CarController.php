<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $date = Carbon::now();
        $cars = Car::with(Car::$arrWith)
            ->where('user_id', Auth::id())
            ->orderBy('status', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        $availableType = Car::$availableType;
        $ownerType = Car::$ownerType;

        return view('account.car', compact(['cars', 'availableType', 'ownerType']));
    }
}
