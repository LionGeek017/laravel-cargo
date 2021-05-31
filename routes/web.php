<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FAQController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\Admin as Admin;
use App\Http\Controllers\Account as Account;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', [HomeController::class, 'index'])->name('home');



//Route::get('countries-and-cities/', 'CountryController@index');
Route::get('/', [HomeController::class, 'index'])->name('index');

//Route::get('countries-and-cities/', [CountryController::class, 'index']);
//Route::get('add-country/{id}', [CountryController::class, 'addCountry']);

// Cars
Route::get('car/search', [CarController::class, 'search'])->name('car.search');
//Route::get('car/my', [CarController::class, 'carMy'])->name('car.car_my');
Route::patch('car/update/', [CarController::class, 'updatePublish'])->name('car.update_publish');
Route::patch('car/deactivate/', [CarController::class, 'destroyPublish'])->name('car.destroy_publish');
Route::get('car/ajax/map_car', [CarController::class, 'mapCar']);
Route::resource('/car', CarController::class);

// Cargos
Route::get('cargo/', [CargoController::class, 'index'])->name('cargo.index');
Route::get('cargo/search/', [CargoController::class, 'search'])->name('cargo.search');
Route::get('cargo/create', [CargoController::class, 'create'])->name('cargo.create');
//Route::get('cargo/my/{type?}', [CargoController::class, 'cargoMy'])->name('cargo.cargo_my');
Route::get('cargo/{id}-{cargo_code}/{cargo_name_slug}', [CargoController::class, 'show'])->name('cargo.show');
Route::get('cargo/edit/{id}', [CargoController::class, 'edit'])->name('cargo.edit');
Route::post('cargo/', [CargoController::class, 'store'])->name('cargo.store');
Route::patch('cargo/update/', [CargoController::class, 'updatePublish'])->name('cargo.update_publish');
Route::patch('cargo/update/{id}', [CargoController::class, 'update'])->name('cargo.update');
Route::patch('cargo/deactivate/', [CargoController::class, 'destroyPublish'])->name('cargo.destroy_publish');
Route::delete('cargo/destroy', [CargoController::class, 'destroy'])->name('cargo.destroy');
Route::get('cargo/ajax/map_cargo', [CargoController::class, 'mapCargo']);

Route::get('blog/', [BlogPostController::class, 'index'])->name('post.index');
Route::get('blog/{category_slug}/{id}-{post_slug}', [BlogPostController::class, 'show'])->name('post.show');
Route::get('blog/{category_slug}', [BlogCategoryController::class, 'index'])->name('category.index');

Route::get('content/{slug}', [ContentController::class, 'index'])->name('content.index');
Route::get('faq', [FAQController::class, 'index'])->name('faq.index');

Route::get('subscriptions/', [SubscriptionController::class, 'index'])->name('subscription.index');

Auth::routes();
Route::get('new-country/{code?}', [UserController::class, 'newCountry']);

// Account
Route::prefix('/account')->name('account.')->group(function() {
    Route::get('/cargo', [Account\CargoController::class, 'index'])->name('cargo');
    Route::get('/car', [Account\CarController::class, 'index'])->name('car');
    Route::get('/subscriptions', [Account\SubscriptionController::class, 'index'])->name('subscriptions');
    Route::get('/settings', [Account\SettingController::class, 'index'])->name('settings');
    Route::patch('/settings/update-data/{user}', [Account\SettingController::class, 'updateData'])->name('settings.update_data');
    Route::patch('/settings/update-pass/{user}', [Account\SettingController::class, 'updatePass'])->name('settings.update_pass');
});

// Admin
Route::prefix('/adminchik')->name('adminchik.')->group(function () {
    Route::get('/', [Admin\HomeController::class, 'index'])->name('index');
    Route::resource('/users', Admin\UserController::class);
    Route::resource('/cargos', Admin\CargoController::class);
    Route::resource('/cars', Admin\CarController::class);
    Route::resource('/blog/categories', Admin\BlogCategoryController::class);
    Route::resource('/blog/posts', Admin\BlogPostController::class);
    Route::resource('/metatags', Admin\MetaTagController::class);
    Route::resource('/contents', Admin\ContentController::class);
    Route::resource('/faqs', Admin\FaqController::class);
    Route::resource('/subscriptions/history', Admin\SubscriptionHistoryController::class);
    Route::resource('/subscriptions', Admin\SubscriptionController::class);

    Route::resource('/countries', Admin\CountryController::class);
    Route::resource('/regions', Admin\RegionController::class);
    Route::resource('/cities', Admin\CityController::class);
});
