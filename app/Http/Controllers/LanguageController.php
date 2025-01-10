<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        // Get the selected language from the request
        $language = $request->input('language');


        // Set the application locale to the selected language
        app()->setLocale($request['lang']);

        // Store the selected language in session or any other method you prefer
        session(['locale' => $language]);

        // Return a response (you can customize the response as per your requirements)
        return redirect()->route('home',app()->getLocale());
    }
}
