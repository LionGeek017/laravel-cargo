<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
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

    public function contacts(User $user) {
        foreach ($user->subscriptions as $sub) {
            if(($sub->type == 1 || $sub->type == 3) && Carbon::now() < $sub->date_end)
                return true;
        }
        return false;
    }

    public function optional(User $user, Car $car) {
        foreach ($user->roles as $role) {
            if(in_array($role->name, $this->rolesArr))
                return true;
        }

        if($user->id == $car->user_id)
            return true;

        return false;
    }

    public function update(User $user, Car $car) {
        foreach ($user->roles as $role) {
            if(in_array($role->name, $this->rolesArr))
                return true;
        }
        if($user->id == $car->user_id)
            return true;

        return false;
    }

    public function destroy(User $user, Car $car) {
        foreach ($user->roles as $role) {
            if($role->name == $this->rolesArr[0])
                return true;
        }
        if($user->id == $car->user_id)
            return true;

        return false;
    }
}
