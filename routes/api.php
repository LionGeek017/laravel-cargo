<?php

use App\Http\Controllers\ApiController;
//use App\Http\Controllers\CarController;
//use App\Http\Controllers\CargoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\CountryController;
//use App\Http\Controllers\RegionController;
//use App\Http\Controllers\CityController;
use App\Http\Controllers\Api\User as User;
use App\Http\Controllers\Api\Car as Car;
use App\Http\Controllers\Api\Cargo as Cargo;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::prefix('auth')->group(function() {
//    Route::post('register', [Auth\RegisterController::class, '__invoke']);
//    Route::post('login', [Auth\LoginController::class, '__invoke']);
//    Route::post('logout', [Auth\LogoutController::class, '__invoke'])->middleware('auth:api');
//});
Route::prefix('users/v1')->group(function() {
    Route::post('register', [User\UserController::class, 'registration']);
    Route::post('resetPassword', [User\UserController::class, 'resetPassword']);
    Route::post('login', [User\UserController::class, 'login']);
    Route::post('logout', [User\UserController::class, 'logout'])->middleware('auth:api');
});

Route::middleware('auth:api')->prefix('users/v1')->group(function() {
    Route::get('account', [User\UserController::class, 'account']);
    Route::resource('/users', User\UserController::class);
});

//Route::get('database.getCountries', [CountryController::class, 'apiCountry']);
//Route::get('database.getRegions', [RegionController::class, 'apiRegion']);
//Route::get('database.getCities', [CityController::class, 'apiCity']);

Route::get('database.getCountries', [ApiController::class, 'apiCountry']);
Route::get('database.getRegions', [ApiController::class, 'apiRegion']);
Route::get('database.getCities', [ApiController::class, 'apiCity']);

Route::middleware(['web'])->group(function () {
    Route::get('database.showContactsCar', [ApiController::class, 'contactCar']);
    Route::get('database.showContactsCargo', [ApiController::class, 'contactCargo']);
});

Route::prefix('v1')->group(function() {
    Route::get('database.getCargo', [Cargo\CargoController::class, 'getCargo']);
    Route::get('database.getCar', [Car\CarController::class, 'getCar']);
});



