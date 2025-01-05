<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       
        $request->authenticate();
        $user = Auth::user();
            // Check if the user is active
    if ($user->status !== 1 && $user->role !== 'admin') {
        // If the user is inactive, log them out and display an error message
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect back with an error message
        return redirect()->route('login')->withErrors([
            'status' => 'You are inactive. Please contact support.',
        ]);
    }

        $request->session()->regenerate();
        if ($user->role === 'admin') {
            return redirect('/admin');  // Redirect directly to /admin URL
        } else {
            return redirect()->route('dashboard');  // Redirect to user dashboard
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
