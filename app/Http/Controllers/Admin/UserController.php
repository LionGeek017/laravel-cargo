<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\ViewComposers\CountriesComposer;
use App\Models\Cargo;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
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
    public function index()
    {
        $user = User::class;
        $this->authorize('view', $user);
        //withTrashed
        $users = User::with(User::$withRelations)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $status = User::$status;

        return view('admin.users-list', compact('users', 'status', 'user'));
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
        $user = User::with(User::$withRelations)
            ->findOrFail($id);
        return view('admin.user-show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(['roles'])->findOrFail($id);
        $roles = Role::all();
        return view('admin.user-edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        if(Gate::denies('update', User::class)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для редактирования этого пользователя');
        }
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status ? 1 : 0;
        $user->update();

        if($request->role > 0) {
            RoleUser::where('user_id', $id)->delete();
            foreach ($request->role as $role) {
                $roleUser = new RoleUser();
                $roleUser->user_id = $id;
                $roleUser->role_id = $role;
                $roleUser->save();
            }
        }

        if(!$request->status) {
            Functions::statusCargoCar($id);
        }
        return redirect()->route('adminchik.users.show', ['user' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('destroy', User::class)) {
            return Redirect::back()->with('prohibited', 'У вас нет прав для удаления этого пользователя');
        }
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->update();
        $user->delete();
        Functions::statusCargoCar($id);
        return Redirect::back()->with('success', 'Пользователь успешно удален');
    }
}
