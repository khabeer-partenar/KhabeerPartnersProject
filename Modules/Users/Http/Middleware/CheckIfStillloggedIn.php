<?php

namespace Modules\Users\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Entities\User;

class CheckIfStillLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()) {
            if (Carbon::parse(auth()->user()->last_time_active)->diffInMinutes(now()) > config('auth.logout_after')) {
                auth()->logout();
                return redirect()->to('/login');
            } else {
                $user = User::where('id', auth()->id())->first();
                $user->update(['last_time_active' => now()]);
            }
        }
        return $next($request);
    }
}
