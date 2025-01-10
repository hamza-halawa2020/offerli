<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Retrieve the user's preferred locale from the session
        $locale = $request->session()->get('locale') ? $request->session()->get('locale')  : 'en';

        // Set the application locale based on the session value
        if ($locale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
