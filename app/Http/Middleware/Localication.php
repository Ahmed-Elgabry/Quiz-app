<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Support\Facades\Session;

class Localication
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
        //handemade
        if(Session::has('lang')){
            App::setLocale(session('lang', config('app.locale')));
        }
        //2>> in kernel.php >> this middleware in automatic
        return $next($request);
    }
}
