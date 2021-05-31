<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingUserRequest;
use App\Http\Requests\SettingPassRequest;
use App\Models\Setting;
use App\Models\User;
use App\Policies\SettingPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        return view('account.settings-form', compact('user'));
    }

    public function updateData(SettingUserRequest $request, $id) {

        if($request->user()->id != $id) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для обновления');
        }
        $user = User::findOrFail($id);
        $user->update($request->all());
//        $user->update($this->validate($request, [
//            'name' => 'required|min:3|max:255',
//        ]));
        return Redirect::back()->with('success', 'Данные успешно обновлены');

    }

    public function updatePass(SettingPassRequest $request, $id) {

        if($request->user()->id != $id) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для обновления');
        }
        $userPassword = $request->user()->password;
        if(!Hash::check($request->password, $userPassword)) {
            return Redirect::back()->with('prohibited', 'Текущий пароль указан не верно');
        }
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password_new);
        $user->update();
        return Redirect::back()->with('success', 'Пароль успешно изменен');

    }
}
