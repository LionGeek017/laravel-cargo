<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use Laravel\Passport\HasApiTokens;
use App\Http\ViewComposers\CountriesComposer;
use App\Notifications\InvocePaid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    public static $status = [
        'блок',
        'активный'
    ];
    public static $withRelations = [
        'roles',
        'cargos',
        'cars'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active',
        'ip',
        'country',
        'device'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_active' => 'datetime'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function cargos() {
        return $this->hasMany(Cargo::class);
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }

    public function subscriptions() {
        return $this->hasMany(SubscriptionHistory::class);
    }

    public function isOnline() {
        return Cache::has('user-is-online-' . $this->id);
    }

}
