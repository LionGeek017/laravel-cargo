<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;

class RuleController extends Controller
{
    public static function viewAdmin(User $user) {
        $rolesArr = ['admin', 'moderator', 'content-manager'];
        foreach ($user->roles as $role) {
            if(in_array($role->name, $rolesArr))
                return true;
        }
        return false;
    }

    public static function viewUsers(User $user) {
        $rolesArr = ['admin', 'moderator'];
        foreach ($user->roles as $role) {
            if(in_array($role->name, $rolesArr))
                return true;
        }
        return false;
    }
}
