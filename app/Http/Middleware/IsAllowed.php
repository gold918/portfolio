<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IsAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $resource)
    {
        $userRoles = Auth::user()->role->rules()->pluck('title')->all();

            if(Gate::allows($resource, $userRoles)) {
                return $next($request);
            }
            abort(403);
    }
}
