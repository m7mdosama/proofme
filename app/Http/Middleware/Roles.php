<?php

namespace App\Http\Middleware;

use Closure;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roleId)
    {
        $roleIds = explode("-", $roleId);

       if( ! in_array(\Auth::user()->role_id, $roleIds)) {
           return abort(404);
       }

       return $next($request);
    }
}
