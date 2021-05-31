<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    public $rolesArr = ['admin', 'moderator'];

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user) {
        foreach ($user->roles as $role) {
            if(in_array($role->name, $this->rolesArr))
                return true;
        }
        return false;
    }

    public function edit(User $user) {
        foreach ($user->roles as $role) {
            if(in_array($role->name, $this->rolesArr))
                return true;
        }
        return false;
    }

    public function update(User $user) {
        foreach ($user->roles as $role) {
            if(in_array($role->name, $this->rolesArr))
                return true;
        }
        return false;
    }

    public function destroy(User $user) {
        foreach ($user->roles as $role) {
            if($role->name == $this->rolesArr[0])
                return true;
        }
        return false;
    }
}
