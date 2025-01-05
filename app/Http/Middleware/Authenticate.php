<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
         // If the request expects a JSON response (for APIs), return null, else redirect to login page
         if ($request->expectsJson()) {
            return null;
        }

        // If the user is not authenticated, redirect to the login page
        return route('login');
    }
}
