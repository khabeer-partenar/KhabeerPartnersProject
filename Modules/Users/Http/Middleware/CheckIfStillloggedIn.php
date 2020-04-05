<?php

namespace Modules\Users\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if (Carbon::parse(auth()->user()->last_time_active)->diffInMinutes(now()) < 1) {
                auth()->user()->update(['last_time_active' => now()]);
            } else {
                auth()->logout();
                return redirect()->to('/login');
            }
        }
        return $next($request);
    }
}
