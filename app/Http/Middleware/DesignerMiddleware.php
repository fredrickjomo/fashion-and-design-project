<?php

namespace App\Http\Middleware;

use Closure;

class DesignerMiddleware
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
        if($request->user()->user_type!='designer'){
            return redirect()->route('NOT_FOUND');
        }
        return $next($request);
    }
}
