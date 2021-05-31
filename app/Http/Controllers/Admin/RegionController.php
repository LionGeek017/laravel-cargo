<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Requests\RegionRequest;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Region::with(Region::$withRelations);
        if($request->has('country_id')) {
            $query->where('country_id', $request->country_id);
        }
        $regions = $query->orderBy('name')
            ->paginate(50)
            ->withQueryString();;
        return view('admin.countries.regions', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $countryId = null;
        if($request->has('country_id')) {
            $countryId = $request->country_id;
        }
        $countries = Country::all();
        return view('admin.countries.region-create', compact('countries', 'countryId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $request)
    {
        if(Region::where('vk_id', $request->vk_id)->count() > 0) {
            return redirect()->back()->with('prohibited', 'Регион с VK ID ' . $request->vk_id . ' уже существует');
        }
        $country = Country::findOrFail($request->country_id);
        $region = new Region();
        $region->name = $request->name;
        $region->country_id = $request->country_id;
        $region->vk_id = $request->vk_id;
        $region->save();
        $regionIds = [
            ['region_id' => $region->id, 'vk_id' => $region->vk_id]
        ];
        EventController::cityLoading($regionIds, $country);
        return redirect()->route('adminchik.regions.index', ['country_id' => $request->country_id])->with('success', 'Регион добавлен, города загружаются в фоновом режиме');
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
        $countries = Country::all();
        $region = Region::findOrFail($id);
        return view('admin.countries.region-edit', compact('countries', 'region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);
        if($request->has('renew')) {
            $country = Country::where('id', $region->country_id)->first();
            $regionIds = [
                ['region_id' => $region->id, 'vk_id' => $region->vk_id]
            ];
            EventController::cityLoading($regionIds, $country);
            return redirect()->route('adminchik.regions.index')->with('success', 'Города загружаются в фоновом режиме');
        }

        $region = Region::findOrFail($id);
        $region->name = $request->name;
        $region->country_id = $request->country_id;
        $region->vk_id = $request->vk_id;
        $region->update();
        return redirect()->route('adminchik.regions.index', ['country_id' => $region->country_id])->with('success', 'Данные региона успешно обновлены');
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
