<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use App\Rules\CaptchaRule;
use Illuminate\Validation\Rule;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */


    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->validate([
                'g-recaptcha-response' => ['required', new CaptchaRule],
            ]);

            $request->authenticate();

            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        } catch (ValidationException $e) {
            return redirect()->route('login')
                ->withErrors($e->errors())
                ->withInput($request->except('password'));
        } catch (\Exception $e) {
            if (Auth::check() && !Auth::user()->active) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account is not active.');
            }
            return redirect()->route('login')->with('error', 'Something went wrong. Please try again.');
        }
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home', ['locale' => app()->getLocale()]);
    }
}
