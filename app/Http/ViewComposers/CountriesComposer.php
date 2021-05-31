<?php
namespace App\Http\ViewComposers;

use App\Models\Country;
use App\Models\IPGeoBase;
use http\Env\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;


class CountriesComposer
{

    public static function userGeo($userIp = null) {
        $userIp = $userIp ?? request()->ip();
        $gb = new IPGeoBase(base_path() . '/vendor/ipgeobase/data/cidr_optim.txt', base_path() . '/vendor/ipgeobase/data/cities.txt');
        return $gb->getRecord($userIp);
    }

    public static function userCountryCode($userGeo = null) {
        $userGeo = $userGeo ?? self::userGeo();
        $countryCode = $userGeo ? $userGeo['cc'] : 'UA';

        if(Auth::user()) {
            $countryCode = Auth::user()->country;
        }

        return Str::upper(request()->cookie('user_country_code', $countryCode));
    }

    public static function compose(View $view)
    {
        $countries = Country::all();

        $countryUserRow = $countries->first(function ($item) {
            return $item->code == self::userCountryCode();
        });

        $view->with('countries', $countries);
        $view->with('countryUser', $countryUserRow);

        return $view;
    }

    public static function userCountry()
    {
        $countries = Country::all();
        return $countries->first(function ($item) {
            return $item->code == self::userCountryCode();
        });
    }
}
