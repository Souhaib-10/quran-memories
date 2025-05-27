<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login.quran')->with('error', 'You must be logged in to access this page.');
        }

        $user = Auth::user();

        // Check if the role matches the user's role
        if ($role === 'superAdmin' && !$user->isSuperAdmin()) {
            abort(403, 'You are not authorized to access this page.');
        }

        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'You are not authorized to access this page.');
        }

        // Allow the request to proceed
        return $next($request);
    }
}
