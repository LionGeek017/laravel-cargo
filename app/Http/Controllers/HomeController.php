<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Http\ViewComposers\CountriesComposer;
use App\Jobs\SendMessage;
use App\Models\MetaTag;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\CookieController;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;




class HomeController extends Controller
{
    public $metaTags = [];

    public function __construct()
    {
        $query = MetaTag::findOrFail(1);
        $this->metaTags = [
            'title' => $query->title,
            'keywords' => $query->keywords,
            'description' => $query->description,
            'slogan_top' => $query->slogan_top,
            'seo_text' => $query->seo_main,
        ];
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userCountry = CountriesComposer::userCountry();
        $ownerMax = Cargo::$ownerMax;
        $metaTags = (object)$this->metaTags;

        $cargos = Cargo::with(Cargo::$withRelations)
            ->where('country_id_from', $userCountry->id)
            ->where('country_id_to', $userCountry->id)
            ->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->limit(6)
            ->get();

        return view('layouts.content-home', compact('cargos', 'ownerMax', 'metaTags'));
    }

}
