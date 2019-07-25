<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
        
        if(Auth::user()->type == 'admin')
        {
           return $next($request);
        }

        toast('Permiso denegado', 'error' ,'top-right');
        
        return redirect()->back();
    }
}
