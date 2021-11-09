<?php

namespace App\Http\Middleware;

use Closure;

class Locale
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
        //$raw_locale = Session::get('locale');
        $raw_locale = $request->session()->get('locale');
        if (in_array($raw_locale, config()->get('app.locales'))) {
            $locale = $raw_locale;
        }
        else $locale = config()->get('app.locale');
        app()->setLocale($locale);
        return $next($request);
    }
}
