<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    
    public function handle($request, Closure $next)
    {
        if(!auth('admin')->check()){
            return redirect()->route('dashboard.login');
 
        }
        return $next($request);
    }
}
