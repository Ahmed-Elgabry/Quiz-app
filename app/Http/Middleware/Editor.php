<?php

namespace App\Http\Middleware;

use Closure;

class Editor
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
        if(auth()->user()->is_editor){
            return $next($request);
        }else{
            abort(404);
        }
    }
}
