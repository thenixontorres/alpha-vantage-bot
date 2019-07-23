<?php

namespace App\Http\Middleware;

use Closure;

class OnMiddleware
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
        if (getSetting('status') == 'on') {
            return $next($request);
        }else{

            toast('El escaner esta apagado.', 'warning' ,'top-right');

            return redirect()->route('backoffice.index');
        }
    }
}
