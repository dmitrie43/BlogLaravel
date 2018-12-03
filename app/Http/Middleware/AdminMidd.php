<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMidd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) //Внедряется до доступа к конечному маршруту
    {
        if(Auth::check() && Auth::user()->is_admin)
        {
            return $next($request);
        }
        abort(404);
    }
}
