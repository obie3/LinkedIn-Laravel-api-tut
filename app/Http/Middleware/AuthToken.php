<?php

namespace App\Http\Middleware;

use Closure;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $token = $request->header('X-API-TOKEN');
        if('test-value' != $token){
            abort(401, 'Authentication token not found');
        }
        return $next($request);
    }
}
