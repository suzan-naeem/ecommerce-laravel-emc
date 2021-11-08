<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    
    public function handle($request, Closure $next)
    {
        if(auth('admin')->check()){
            return view('dashboard.index'); 
        }
        return $next($request);
    }
}
