<?php

namespace App\Http\Controllers;

//use App\Http\Request\StoreCargoRequest;
use App\Helpers\Functions;
use App\Http\Requests\CargoRequest;
use App\Http\ViewComposers\CountriesComposer;
use App\Models\CarBody;
use App\Models\Cargo;
use App\Models\CarWeight;
use App\Models\City;
use App\Models\Country;
//use App\Models\User;
use App\Models\Currency;
use App\Models\MetaTag;
use App\Models\PayType;
use App\Models\PriceType;
use App\Models\Region;
//use Illuminate\Auth\Access\Gate;
//use Illuminate\Filesystem\Cache;
use App\Models\User;
use App\Notifications\InvocePaid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
//use Psy\Util\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\Object_;


use App\Http\Controllers\CookieController;

//use Illuminate\Pagination\Paginator;
//use Illuminate\View\View;
//use PHPUnit\Framework\Constraint\Count;
//use Symfony\Component\HttpFoundation\Response;

//use Config;


class CargoController extends Controller
{
    use Notifiable;

    public function __construct() {
        $this->middleware('auth')->except('index', 'show', 'search', 'mapCargo');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Cargo Search
     */
    public function search(Request $request)
    {
        //$user = User::first();
        //$user->notify(new InvocePaid);

        $queryMetaTags = MetaTag::findOrFail(1);
        $metaTags = (object)[
            'title' => 'Поиск попутного груза',
            'keywords' => 'Поиск груза, попутный груз',
            'description' => 'Поиск попутного груза',
            'seo_text' => $queryMetaTags->seo_cargo,
        ];

        $userCountry = CountriesComposer::userCountry();
        $ownerMax = Cargo::$ownerMax;
        $date = Carbon::now();
        $formData = (object) []; //self::formData();//$userCountry->id, $userCountry->id, null, null, true
        $formData->countries = Country::all();

        $query = Cargo::with(Cargo::$withRelations);

        if($request->has('country_id_from')) {
            $query->where('country_id_from', $request->country_id_from);
            $regionsFrom = Region::regionsCountry($request->country_id_from);
        } else {
            $query->where('country_id_from', $userCountry->id);
            $regionsFrom = Region::regionsCountry($userCountry->id);
        }

        if($request->region_id_from != 0) {
            $query->where('region_id_from', $request->region_id_from);
            $citiesFrom = City::citiesRegion($request->region_id_from);
        } else {
            $citiesFrom = null;
        }

        if($request->city_id_from != 0) {
            $query->where('city_id_from', $request->city_id_from);
        }

        if($request->has('country_id_to')) {
            $query->where('country_id_to', $request->country_id_to);
            $regionsTo = Region::regionsCountry($request->country_id_to);
        } else {
            $query->where('country_id_to', $userCountry->id);
            $regionsTo = Region::regionsCountry($userCountry->id);
        }

        if($request->region_id_to != 0) {
            $query->where('region_id_to', $request->region_id_to);
            $citiesTo = City::citiesRegion($request->region_id_to);
        } else {
            $citiesTo = null;
        }

        if($request->city_id_to != 0) {
            $query->where('city_id_to', $request->city_id_to);
        }

        if($request->car_weight_id != 0) {
            $query->where('car_weight_id', $request->car_weight_id);
        }

        if($request->car_body_id != 0) {
            $query->where('car_body_id', $request->car_body_id);
        }

        if($request->order == 'distance' || $request->order == 'price') {
            $orderField = $request->order;
        } else {
            $orderField = 'updated_at';
        }

        if($request->has('direction')) {
            $orderValue = $request->direction;
        } else {
            $orderValue = 'desc';
        }
        $query->where('status', 1);
        $cargos = $query->orderBy($orderField, $orderValue)
            ->paginate(10);

        $urlSearchOrder = $request->all();
        Arr::pull($urlSearchOrder, 'order');
        $urlSearchOrder = http_build_query($urlSearchOrder);

        $urlSearchDirection = $request->all();
        Arr::pull($urlSearchDirection, 'direction');
        $urlSearchDirection = http_build_query($urlSearchDirection);

        $formData->regionsFrom = $regionsFrom;
        $formData->regionsTo = $regionsTo;
        $formData->citiesFrom = $citiesFrom;
        $formData->citiesTo = $citiesTo;
        $formData->weights = CarWeight::all();
        $formData->bodies = CarBody::all();

        if($request->mode == 'map')
            return view('cargo.map', compact('cargos', 'ownerMax', 'date', 'formData', 'urlSearchOrder', 'urlSearchDirection', 'metaTags'));
        else
            return view('cargo.list', compact('cargos', 'ownerMax', 'date', 'formData', 'urlSearchOrder', 'urlSearchDirection', 'metaTags'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userCountry = CountriesComposer::userCountry();
        $formData = self::formData();

        if(old('country_id_from')) {
            $regionsFrom = Region::regionsCountry(old('country_id_from'));
        } else {
            $regionsFrom = Region::regionsCountry($userCountry->id);
        }

        if(old('country_id_to')) {
            $regionsTo = Region::regionsCountry(old('country_id_to'));
        } else {
            $regionsTo = Region::regionsCountry($userCountry->id);
        }

        if(old('region_id_from')) {
            $citiesFrom = City::citiesRegion(old('region_id_from'));
        } else {
            $citiesFrom = null;
        }

        if(old('region_id_to')) {
            $citiesTo = City::citiesRegion(old('region_id_to'));
        } else {
            $citiesTo = null;
        }

        $formData->regionsFrom = $regionsFrom;
        $formData->regionsTo = $regionsTo;
        $formData->citiesFrom = $citiesFrom;
        $formData->citiesTo = $citiesTo;

        return view('cargo.create', compact('formData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request) //StoreCargoRequest $request
    {
            Functions::regenerateToken();
            // Добавляем данные, которых нет в форме
            $request->request->add(['cargo_code' => Str::random(8)]);
            $request->request->add(['user_id' => Auth::id()]);
            $request->request->add(['cargo_name_slug' => Str::of($request->cargo_name)->slug('-')]);
            $request->request->add(['status' => 1]);
            $request->request->add(['date_valid' => Carbon::now()->addDay()]);
            // Создаем запись на основе полей формы
            $cargo = Cargo::create($request->all());

            $cargo = Cargo::with(Cargo::$withRelations)->find($cargo->id);

            EventController::cargoReceiveCoordinates($cargo);
            EventController::sendCargoTG($cargo);

            return redirect()->route('cargo.show', ['id' => $cargo->id, 'cargo_code' => $cargo->cargo_code, 'cargo_name_slug' => $cargo->cargo_name_slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $cargo_code)
    {
        $ownerMax = Cargo::$ownerMax;
        $cargo = Cargo::with(Cargo::$withRelations)
            ->where('cargo_code', $cargo_code)
            ->findOrFail($id);

        $metaTags = (object)[
            'title' => $cargo->cargo_name . ' груз ' . $cargo->cityFrom->name . ' - ' . $cargo->cityTo->name . $cargo->carWeight->name . ' / Просмотр груза',
            'keywords' => $cargo->cargo_name . ', попутный груз ' . $cargo->cityFrom->name . ', ' . $cargo->carBody->name,
            'description' => $cargo->cargo_name . ' попутный груз ' . $cargo->cityFrom->name . ' ' . $cargo->regionFrom->name . ' по направлению ' . $cargo->cityTo->name . ' ' . $cargo->regionTo->name . ' ' . $cargo->carBody->name . ' / ' . $cargo->carWeight->name . ' / Оплата ' . $cargo->price . ' ' . $cargo->currency->name . ' ' . $cargo->payType->name,
        ];
        $actual = Functions::actualPublication($cargo->date_valid);

        return view('cargo.show', compact('cargo', 'ownerMax', 'metaTags', 'actual'));
    }

    /**
     * Map Card
     */
    public function mapCargo(Request $request)
    {
        $ownerMax = Cargo::$ownerMax;
        $cargo = Cargo::with(Cargo::$withRelations)
            ->findOrFail($request->id);
        $actual = Functions::actualPublication($cargo->date_valid);

        $result = ['result' => 'ok', 'view' => View::make('cargo.parts.card', compact('cargo', 'ownerMax', 'actual'))->render()];
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargo::with([
            'regionsFromCountryCargo',
            'regionsToCountryCargo',
            'citiesFromRegionCargo',
            'citiesToRegionCargo'
        ])->findOrFail($id);

        $formData = self::formData();
        if(old('country_id_from')) {
            $formData->regionsFrom = Region::regionsCountry(old('country_id_from'));
        } else {
            $formData->regionsFrom = $cargo->regionsFromCountryCargo;
        }
        if(old('country_id_to')) {
            $formData->regionsTo = Region::regionsCountry(old('country_id_to'));
        } else {
            $formData->regionsTo = $cargo->regionsToCountryCargo;
        }
        if(old('region_id_from')) {
            $formData->citiesFrom = City::citiesRegion(old('region_id_from'));
        } else {
            $formData->citiesFrom = $cargo->citiesFromRegionCargo;
        }
        if(old('region_id_to')) {
            $formData->citiesTo = City::citiesRegion(old('region_id_to'));
        } else {
            $formData->citiesTo = $cargo->citiesToRegionCargo;
        }

        $formData->cargo = $cargo;

        return view('cargo.edit', compact('formData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CargoRequest $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        if($request->user()->cannot('update', $cargo)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для обновления');
        }

        Functions::regenerateToken();

        $request->request->add(['status' => 1]);
        $request->request->add(['date_valid' => Carbon::now()->addDay()]);
        $cargo->update($request->all());
        return redirect()->route('cargo.show', ['id' => $cargo->id, 'cargo_code' => $cargo->cargo_code, 'cargo_name_slug' => $cargo->cargo_name_slug]);
    }

    // Обновляем дату актуальности и статус
    public function updatePublish(Request $request) {
        $cargo = Cargo::findOrFail($request->id);
        if($request->user()->cannot('update', $cargo)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для обновления');
        }
        $cargo->date_valid = Carbon::now()->addDay();
        $cargo->status = 1;
        $cargo->update();
        return Redirect::back()->with('success', 'Дата актуальности успешно обновлена!');
    }

    // Отменяем публикацию
    public function destroyPublish(Request $request) {
        $cargo = Cargo::findOrFail($request->id);
        if($request->user()->cannot('update', $cargo)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для отмены публикации');
        }
        $cargo->date_valid = Carbon::now();
        $cargo->status = 0;
        $cargo->update();
        return Redirect::back()->with('success', 'Публикация отменена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cargo = Cargo::findOrFail($request->id);
        if($request->user()->cannot('destroy', $cargo)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для удаления этого груза');
        }

        $cargo->delete();
        return Redirect::back()->with('success', 'Груз удален!');
    }

    // Данные для заполнения форм при создании, редактировании и поиске груза
    public static function formData() {
        return (object) [
            'countries' => Country::all(),
            'weights' => CarWeight::all(),
            'bodies' => CarBody::all(),
            'currencies' => Currency::all(),
            'priceTypes' => PriceType::all(),
            'payTypes' => PayType::all(),
            'ownerTypes' => Cargo::$ownerMax,
        ];
    }

}
