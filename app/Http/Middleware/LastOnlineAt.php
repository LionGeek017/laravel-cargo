<?php

namespace App\Http\Middleware;

use App\Http\Controllers\EventController;
use App\Notifications\AccountLogin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LastOnlineAt
{
    use Notifiable;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Если гость, то возвращаемся на сайт
        if(auth()->guest()) {
            return $next($request);
        }
        // Если авторизовался, то проверяем время активности
        $lastActive = auth()->user()->last_active->diffInHours(now());
        if($lastActive !== 0) {
            DB::table('users')
                ->where('id', auth()->user()->id)
                ->update(['last_active' => now()]);

            $user = User::findOrFail(auth()->user()->id);
            $user->notify(new AccountLogin);
        }

        return $next($request);
    }
}
