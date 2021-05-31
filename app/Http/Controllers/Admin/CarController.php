<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ownerType = Car::$ownerType;
        $availableType = Car::$availableType;
        $user = $request->user();
        $query = Car::with(Car::$arrWith);
        if($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        $cars = $query->orderBy('id', 'desc')
            ->paginate(10)->withQueryString();
        if($request->has('user_id')) {
            $userCar = User::findOrFail($request->user_id);
            return view('admin.cars-list-user', compact('cars', 'user', 'userCar', 'ownerType', 'availableType'));
        }
        return view('admin.cars-list', compact('cars', 'user', 'ownerType', 'availableType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
