<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\AccountLogin;
use App\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Notifiable;

    public function __construct()
    {
        //$this->middleware('account');
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function account()
    {
        $user = User::with(User::$withRelations)->findOrFail(auth()->id());
        return response()->json([
            "message" => "Данные пользователя",
            "data" => $user
        ], 200);
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

    /**
     * Registration User
     */
    public function resetPassword(Request $request) {
        if(User::where('email', $request->email)->count() > 0) {
            $user = User::where('email', $request->email)->first();

            $tokenReset = Str::random(60);
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'token' => Hash::make($tokenReset)
                ]
            );

            if ($user && $passwordReset) {
                $user->notify(
                    new ResetPassword($tokenReset)
                );
            }


            return response()->json([
                "success" => true,
                'message' => 'Инструкция по сбросу пароля отправлена на почту: ' . $request->email
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                'message' => 'Email ' . $request->email . ' отсутсвует в базе',
                'errors' => 'NoAddress'
            ], 401);
        }
    }

    /**
     * Login User
     */
    public function login(RegisterFormRequest $request) {
        $data = $request->only('email', 'password');
        if(!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Email или пароль введен не верно',
                'errors' => 'Unauthorised'
            ], 401);
        }
//        $token = Auth::user()->createToken(config('app.name'));
//        $token->token->expires_at = Carbon::now()->addMonth();
//        $token->token->save();
        $token = auth()->user()->createToken(config('app.name'))->accessToken;

        return response()->json([
            "success" => true,
            "data" => [
                //"token" => $token->accessToken,
                "token" => $token,
            ],
            "message" => "Вы успешно вошли"
        ], 200);
    }

    /**
     * Logout User
     */
    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Вы вышли с кабинета'
        ], 200);
    }
}
