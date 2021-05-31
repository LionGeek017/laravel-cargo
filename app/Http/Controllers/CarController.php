<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Http\ViewComposers\CountriesComposer;
use App\Models\Car;
use App\Models\CarBody;
use App\Models\Cargo;
use App\Models\CarWeight;
use App\Models\City;
use App\Models\Country;
use App\Models\MetaTag;
use App\Models\Region;
use App\Http\Requests\CarRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CarController extends Controller
{


    public function __construct() {
        $this->middleware('auth')->except('index', 'show', 'search', 'mapCar');
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
     * Car Search
     */
    public function search(Request $request)
    {

        $queryMetaTags = MetaTag::findOrFail(1);
        $metaTags = (object)[
            'title' => 'Поиск автомобиля',
            'keywords' => 'Поиск авто, автомобиль для перевозки',
            'description' => 'Поиск автомобиля для перевозки груза',
            'seo_text' => $queryMetaTags->seo_car,
        ];

        $userCountry = CountriesComposer::userCountry();
        $availableType = Car::$availableType;
        $ownerType = Car::$ownerType;
        $formData = (object) [];
        $formData->countries = Country::all();

        $query = Car::with(Car::$arrWith);

        if($request->has('country_id')) {
            $query->where('country_id', $request->country_id);
            $regions = Region::regionsCountry($request->country_id);
        } else {
            $query->where('country_id', $userCountry->id);
            $regions = Region::regionsCountry($userCountry->id);
        }

        if($request->region_id != 0) {
            $query->where('region_id', $request->region_id);
            $cities = City::citiesRegion($request->region_id);
        } else {
            $cities = null;
        }

        if($request->city_id != 0) {
            $query->where('city_id', $request->city_id);
        }

        if($request->car_weight_id != 0) {
            $query->where('car_weight_id', $request->car_weight_id);
        }

        if($request->car_body_id != 0) {
            $query->where('car_body_id', $request->car_body_id);
        }

        $query->where('status', 1);

        if($request->order == 'weight') {
            $orderField = 'car_weight_id';
        } else if($request->order == 'status') {
            $orderField = 'available';
        } else {
            $orderField = 'updated_at';
        }

        if($request->has('direction')) {
            $orderValue = $request->direction;
        } else {
            $orderValue = 'desc';
        }

        $cars = $query->orderBy($orderField, $orderValue)
            ->paginate(10);

        $urlSearchOrder = $request->all();
        Arr::pull($urlSearchOrder, 'order');
        $urlSearchOrder = http_build_query($urlSearchOrder);

        $urlSearchDirection = $request->all();
        Arr::pull($urlSearchDirection, 'direction');
        $urlSearchDirection = http_build_query($urlSearchDirection);

        $formData->regions = $regions;
        $formData->cities = $cities;
        $formData->weights = CarWeight::all();
        $formData->bodies = CarBody::all();

        if($request->mode == 'map')
            return view('car.map', compact(['cars', 'formData', 'urlSearchOrder', 'urlSearchDirection', 'availableType', 'ownerType', 'metaTags']));
        else
            return view('car.list', compact(['cars', 'formData', 'urlSearchOrder', 'urlSearchDirection', 'availableType', 'ownerType', 'metaTags']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userCountry = CountriesComposer::userCountry();
        $formData = (object)[];
        $formData -> countries = Country::all();

        if(old('country_id')) {
            $regions = Region::regionsCountry(old('country_id'));
        } else {
            $regions = Region::regionsCountry($userCountry->id);
        }

        if(old('region_id')) {
            $cities = City::citiesRegion(old('region_id'));
        } else {
            $cities = null;
        }

        $formData -> regions = $regions;
        $formData -> cities = $cities;
        $formData -> weights = CarWeight::all();
        $formData -> bodies = CarBody::all();

        return view('car.create', compact('formData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        Functions::regenerateToken();
        $car = new Car();

        $car->user_id = Auth::id();
        $car->car_code = Str::random(8);
        $car->status = 1;

        //$request->request->add(['user_id' => Auth::id()]);

        $car->country_id = $request->country_id;
        $car->region_id = $request->region_id;
        $car->city_id = $request->city_id;
        $car->contact_name = $request->contact_name;
        $car->contact_phone = $request->contact_phone;
        $car->car_body_id = $request->car_body_id;
        $car->car_weight_id = $request->car_weight_id;
        $car->is_owner = $request->is_owner ? 1 : 0;
        $car->is_loc_agree = $request->is_loc_agree ? 1 : 0;
        $car->available = $request->available ? 1 : 0;
        $car->date_valid = Carbon::now()->addDay();
        $car->status = 1;

        $car->save();
//        $nextFields = [
//            'user_id' => Auth::id(),
//            'car_code' => Str::random(8),
//            'status' => 1
//        ];
//        $car = Car::create($request->validate());

        EventController::carReceiveCoordinates($car);
        return redirect()->route('car.show', ['car' => $car->id . '-' . $car->car_code]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carData = explode('-', $id);
        $availableType = Car::$availableType;
        $ownerType = Car::$ownerType;
        $car = Car::with(Car::$arrWith)
            ->where('id', $carData[0])
            ->where('car_code', $carData[1])
            ->firstOrFail();
        if(empty($car->loc_lat) || empty($car->loc_lng)) {
            $coordinates = $car->country->name . ',' . $car->city->name . ',' . $car->city->area . ',' . $car->region->name;
        } else {
            $coordinates = $car->loc_lat . ',' . $car->loc_lng;
        }
        $metaTags = (object)[
            'title' => $car->name . ' автомобиль ' . $car->city->name . ' / Просмотр автомобиля',
            'keywords' => $car->name . ', автомобиль ' . $car->city->name . ', ' . $car->carBody->name,
            'description' => $car->name . ' в ' . $car->city->name . ' ' . $car->region->name . ' ' . $car->carBody->name . ' / ' . $car->carWeight->name,
        ];
        $actual = Functions::actualPublication($car->date_valid);
//        if(!$actual) {
//            $car->available = 0;
//            $car->update();
//        }

        return view('car.show', compact('car', 'availableType', 'ownerType', 'coordinates', 'metaTags', 'actual'));
    }

    /**
     * Map Card
     */
    public function mapCar(Request $request)
    {
        $availableType = Car::$availableType;
        $ownerType = Car::$ownerType;
        $car = Car::with(Car::$arrWith)
            ->findOrFail($request->id);
        if(empty($car->loc_lat) || empty($car->loc_lng)) {
            $coordinates = $car->country->name . ',' . $car->city->name . ',' . $car->city->area . ',' . $car->region->name;
        } else {
            $coordinates = $car->loc_lat . ',' . $car->loc_lng;
        }
        $actual = Functions::actualPublication($car->date_valid);

        $result = ['result' => 'ok', 'view' => View::make('car.parts.card', compact('car', 'availableType', 'ownerType', 'coordinates', 'actual'))->render()];
        return response()->json($result);

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::with(Car::$arrWith)->findOrFail($id);
        $formData = (object)[];
        $formData->countries = Country::all();
        if(old('country_id')) {
            $regions = Region::regionsCountry(old('country_id'));
        } else {
            $regions = Region::regionsCountry($car->country->id);
        }

        if(old('region_id')) {
            $cities = City::citiesRegion(old('region_id'));
        } else {
            $cities = City::citiesRegion($car->region->id);
        }

        $formData->regions = $regions;
        $formData->cities = $cities;
        $formData->weights = CarWeight::all();
        $formData->bodies = CarBody::all();
        $formData->car = $car;

        return view('car.edit', compact('formData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, $id)
    {
        Functions::regenerateToken();
        $car = Car::findOrFail($id);

        if($request->user()->cannot('update', $car)) {
            return Redirect::back();
        }

        $car->country_id = $request->country_id;
        $car->region_id = $request->region_id;
        $car->city_id = $request->city_id;
        $car->contact_name = $request->contact_name;
        $car->contact_phone = $request->contact_phone;
        $car->car_body_id = $request->car_body_id;
        $car->car_weight_id = $request->car_weight_id;
        $car->is_owner = $request->is_owner ? 1 : 0;
        $car->is_loc_agree = $request->is_loc_agree ? 1 : 0;
        $car->available = $request->available ? 1 : 0;
        $car->date_valid = Carbon::now()->addDay();
        $car->status = 1;

        $car->update();
        EventController::carReceiveCoordinates($car);
        return redirect()->route('car.show', ['car' => $car->id . '-' . $car->car_code]);
    }

    // Обновляем дату актуальности и статус
    public function updatePublish(Request $request) {
        $car = Car::findOrFail($request->id);
        if($request->user()->cannot('update', $car)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для обновления');
        }
        $car->date_valid = Carbon::now()->addDay();
        $car->available = 1;
        $car->status = 1;
        $car->update();
        return Redirect::back()->with('success', 'Дата актуальности успешно обновлена!');
    }

    // Отменяем публикацию
    public function destroyPublish(Request $request) {
        $car = Car::findOrFail($request->id);
        if($request->user()->cannot('update', $car)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для отмены публикации');
        }
        $car->date_valid = Carbon::now();
        $car->available = 0;
        $car->status = 0;
        $car->update();
        return Redirect::back()->with('success', 'Публикация отменена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//    public static function dataSelects($country_id = null)
//    {
//        $countries = Country::select('id', 'name')->orderBy('name')->get();
//        $regions = Region::select('id', 'name')->where('country_id', $country_id ?? $countries[0]->id)->orderBy('name')->get();
//
//        $regions_arr = [];
//        foreach($regions as $region) {
//            $regions_arr[$region->id] = $region->name;
//        }
//        //$cities = City::select('id', 'region_id', 'name')->where('country_id', $country_id ?? $countries[0]->id)->whereIn('region_id', [implode(',', array_keys($regions_arr))])->get();
//        //$cities->all();
//        $cities = City::select('id', 'region_id', 'name')->where('country_id', $country_id ?? $countries[0]->id)->get();
//
//        $cities_and_regions = [];
//        foreach($cities as $key => $city) {
//            $cities_and_regions[] = [
//                'ids' => ''.$city->id.','.$city->region_id.'',
//                'names' => ''.$city->name.', '.$regions_arr[$city->region_id].''
//            ];
//        }
//
//        $weights = CarWeight::all();
//        $bodys = CarBody::all();
//
//        $data = [
//            'countries' => $countries,
//            'regions' => $regions,
//            'cities' => $cities,
//            'cities_and_regions' => $cities_and_regions,
//            'weights' => $weights,
//            'bodies' => $bodys
//        ];
//
//        return $data;
//    }
}
