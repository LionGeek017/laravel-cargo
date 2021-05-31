<?php

namespace App\Providers;

use App\Http\Controllers\RuleController;
use App\Models\BlogCategory;
use App\Models\BlogPost;

use App\Models\Car;
use App\Models\Role;
use App\Models\Setting;
use App\Policies\BlogCategoryPolicy;
use App\Policies\BlogPostPolicy;
use App\Policies\CargoPolicy;
use App\Policies\CarPolicy;
use App\Policies\SettingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Cargo;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Cargo::class => CargoPolicy::class,
        Car::class => CarPolicy::class,
        BlogPost::class => BlogPostPolicy::class,
        BlogCategory::class => BlogCategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('view-admin', [RuleController::class, 'viewAdmin']);
        Gate::define('view-users', [RuleController::class, 'viewUsers']);
        Passport::routes();

//        Gate::define('view-admin', function(User $user) {
//            foreach ($user->roles as $role) {
//                if($role->name == 'admin')
//                    return true;
//            }
//            return false;
//        });
    }
}
