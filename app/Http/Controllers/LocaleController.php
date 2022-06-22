<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function change(Request $request)
    {
        $locale = $request->input('locale');
        if (array_key_exists($locale, Config::get('locales'))) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }
}
