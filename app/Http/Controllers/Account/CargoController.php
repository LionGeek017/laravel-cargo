<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CargoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * User Cargo
     */
    public function index() {
        $filter = request()->filter;
        $date = Carbon::now();

        $cargos = Cargo::with(Cargo::$withRelations);

        switch ($filter) {
            case 'actual':
                $cargos = $cargos->where('status', 1);
                break;

            case 'archive':
                $cargos = $cargos->where('status', 0);
                break;
        }

        $cargos = $cargos->where('user_id', Auth::id())
            ->orderBy('updated_at', 'asc')
            ->paginate(10);

        $ownerMax = Cargo::$ownerMax;

        return view('account.cargo', compact(['cargos', 'ownerMax', 'date']));
    }

}
