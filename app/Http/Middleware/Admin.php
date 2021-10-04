<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if(!Auth::check()){
            return redirect()->route('login');
    
        }
        // Admin
        if(Auth::user()->role == 1){
            return $next($request);
        }
        // User
        if(Auth::user()->role == 2){
            return redirect()->route('user');
        }
    }
}
