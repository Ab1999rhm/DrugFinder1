<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {

                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'seller':
                        return redirect()->route('seller.dashboard');
                    default:
                        return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}
