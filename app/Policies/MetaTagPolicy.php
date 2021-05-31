<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetaTagPolicy
{
    use HandlesAuthorization;
    public $rolesArr = ['admin', 'moderator', 'content-manager', 'seo-manager'];

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user) {
        foreach ($user->roles as $role) {
            if(in_array($role->name, $this->rolesArr))
                return true;
        }
        return false;
    }
}
