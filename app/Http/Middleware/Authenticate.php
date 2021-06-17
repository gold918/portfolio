<?php

namespace App\Http\Middleware;

use App\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use App\User\Rule;
use Illuminate\Support\Facades\Gate;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }

    }

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $rules = Rule::pluck('title')->all();

        foreach ($rules as $rule) {
            Gate::define($rule, function (User $user, ...$userRole) use ($rule)
            {
                if(in_array($rule, $userRole, true)) {
                    return true;
                }
                return false;
            });
        }

        return $next($request);
    }
}
