<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
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

    public function optional(User $user) {
        foreach ($user->roles as $role) {
            if(in_array($role->name, $this->rolesArr))
                return true;
        }
        return false;
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

    public function view(User $user, BlogPost $post) {
        if(!$post->status) {
            foreach ($user->roles as $role) {
                if(in_array($role->name, $this->rolesArr))
                    return true;
            }
            return false;
        } else {
            return true;
        }
    }
}
