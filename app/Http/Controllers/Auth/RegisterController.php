<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\ViewComposers\CountriesComposer;
use App\Jobs\SendMessage;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3'], //, 'confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //echo CountriesComposer::userCountryCode();
        $ip = request()->ip();
        $userGeo = CountriesComposer::userGeo();
        $code = CountriesComposer::userCountryCode($userGeo);

        $user = User::create([
            'name' => explode('@', $data['email'])[0],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'last_active' => Carbon::now(),
            'ip' => $ip,
            'country' => $code,
            'device' => agentDevice(),
        ]);
        EventController::sendEmail($user->id);
        return $user;
    }
}
