<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSession
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
        if(!Auth::check()) {
            return redirect(route('home.index'));
        }

        $isAdmin = Auth::user()['is_admin'];

        if($isAdmin != '1') {
            return redirect(route('home.index'));
        }

        return $next($request);
    }
}
