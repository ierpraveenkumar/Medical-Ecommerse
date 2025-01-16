<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class LoginAccessPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the admin is already authenticated
        if (Session::has('login_id')) {
            // Admin is already authenticated, redirect to the admin dashboard

            return redirect()->route('admin.dashboard.index');
        }
    
        // If the admin is not authenticated, allow the request to proceed
        return $next($request);
    }
    
}
