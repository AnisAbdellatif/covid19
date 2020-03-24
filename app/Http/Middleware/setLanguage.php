<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class setLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!isset($request->language) || !in_array($request->language, array('en', 'fr')))
        {
            App::setLocale('en');
        } else {
            App::setLocale($request->language);
        }

        return $next($request);
    }
}
