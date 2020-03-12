<?php

namespace OneStop\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            return redirect("/login");
        }

        $roles = is_array($role)
            ? $role
            : explode('|', $role);

           
        if (! Auth::user()->hasAnyRole($roles)) {
            return redirect('/unauthorized');
        }
        return $next($request);
    
    }
}