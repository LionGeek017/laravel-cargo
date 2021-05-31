<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = City::with(City::$withRelations);
        if($request->has('country_id')) {
            $query->where('country_id', $request->country_id);
        } else if($request->has('region_id')) {
            $query->where('region_id', $request->region_id);
        }
        $cities = $query->orderBy('name')
            ->paginate(50)
            ->withQueryString();
        return view('admin.countries.cities', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $countries = Country::all();
        $regions = null;

        $countryId = null;
        $regionId = null;
        if($request->has('country_id')) {
            $countryId = $request->country_id;
            $regions = Region::where('country_id', $countryId)->get();
        }
        if($request->has('region_id')) {
            $regionId = $request->region_id;
        }

        return view('admin.countries.city-create', compact('countries', 'regions', 'countryId', 'regionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        if(City::where('vk_id', $request->vk_id)->count() > 0) {
            return redirect()->back()->with('prohibited', 'Город с VK ID ' . $request->vk_id . ' уже существует');
        }
        City::create($request->all());
        return redirect()->route('adminchik.cities.index', ['region_id' => $request->region_id])->with('success', 'Город успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $countryId = null;
        $regionId = null;
        $city = City::findOrFail($id);
        $countries = Country::all();
        $regions = Region::all();
        return view('admin.countries.city-edit', compact('city', 'countries', 'regions', 'countryId', 'regionId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
        return redirect()->route('adminchik.cities.index', ['region_id' => $city->region_id])->with('success', 'Город успешно добавлен');
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
}
