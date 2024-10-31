<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // If the user is already logged in and trying to access the login page
            if ($request->is('/')) { // Assuming '/' is your login route
                return redirect('vendor/dashboard'); // Redirect to the vendor dashboard
            }

            // Check if the user has the correct role
            if (Auth::user()->is_role == 1) {
                // Allow access and set cache headers on the response
                $response = $next($request);

                return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                    ->header('Pragma', 'no-cache')
                    ->header('Expires', '0');
            } else {
                // Redirect if the user doesn't have the vendor role
                return redirect('/vendor/dashboard');
            }
        }

        // Log out and redirect to login if the user is not authenticated
        Auth::logout();
        return redirect('/');
    }
}
