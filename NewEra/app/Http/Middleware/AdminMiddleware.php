<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is logged in and has the correct role (admin)
        if (auth()->check() && auth()->user()->username === 'admin123' && auth()->user()->role === 'Staff') {
            return $next($request);
        }

        // Redirect if not an admin
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
