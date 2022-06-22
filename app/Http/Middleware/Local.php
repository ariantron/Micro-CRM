<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Local
{
    public function handle($request, Closure $next)
    {
        if (Session::has('locale') and array_key_exists(Session::get('locale'), Config::get('locales'))) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
}
