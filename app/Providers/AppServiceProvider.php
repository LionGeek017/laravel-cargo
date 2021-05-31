<?php

namespace App\Providers;

use App\Http\ViewComposers\CountriesComposer;
use App\Http\ViewComposers\DataComposer;
use App\Http\ViewComposers\LinkPageStatic;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*', CountriesComposer::class);
        view()->composer('*', DataComposer::class);

        if(explode('/', Request::path())[0] == 'adminchik') {
            view()->composer('*', LinkPageStatic::class);
        }

//        Blade::directive('linkactive', function($route) {
//            $param = Route::is($route) ? 'active' : 'no';
//            return $param;
//        });
    }
}
