<?php

namespace App\Providers;

use App\Events\SendCargoTG;
use App\Events\SendMail;
use App\Notifications\AccountLogin;
use App\Listeners\AccountLoginFired;
use App\Listeners\SendCargoTGFired;
use App\Listeners\SendMailFired;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
//        SendMail::class => [
//            SendMailFired::class
//        ],
        SendCargoTG::class => [
            SendCargoTGFired::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
