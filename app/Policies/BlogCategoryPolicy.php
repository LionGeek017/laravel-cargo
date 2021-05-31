<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogCategoryPolicy
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

    public function create(User $user) {
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
}
