<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countriesAdmin = Country::with(Country::$withRelations)
            ->orderBy('id')
            ->paginate(10);
        $status = Country::$status;
        return view('admin.countries.countries', compact('countriesAdmin', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.countries.country-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        if(Country::where('vk_id', $request->vk_id)->count() > 0) {
            return redirect()->back()->with('prohibited', 'Страна с VK ID ' . $request->vk_id . ' уже существует');
        }
        $country = new Country();
        $country->name = $request->name;
        $country->code = $request->code;
        $country->vk_id = $request->vk_id;
        $country->status_from = $request->status_from ? 1 : 0;
        $country->active = $request->active ? 1 : 0;
        $country->save();
        EventController::regionLoading($country);
        return redirect()->route('adminchik.countries.index')->with('success', 'Страна добавлена, регионы и города загружаются в фоновом режиме');
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
        $country = Country::findOrFail($id);
        return view('admin.countries.country-edit', compact('country'));
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
        $country = Country::findOrFail($id);
        if($request->has('renew')) {
            EventController::regionLoading($country);
            return redirect()->route('adminchik.countries.index')->with('success', 'Регионы и города загружаются в фоновом режиме');
        }

        $country->name = $request->name;
        $country->code = $request->code;
        $country->vk_id = $request->vk_id;
        $country->status_from = $request->status_from ? 1 : 0;
        $country->active = $request->active ? 1 : 0;
        $country->update();

        return redirect()->route('adminchik.countries.index')->with('success', 'Данные страны успешно обновлены');
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
