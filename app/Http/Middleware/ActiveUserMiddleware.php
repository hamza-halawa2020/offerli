<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ActiveUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && !Auth::user()->active) {
            // User is not active, handle accordingly
            Auth::logout(); // Log out the inactive user
            return redirect()->route('login')->with('error', 'Your account is not active.');
        }

        return $next($request);
    }
}
