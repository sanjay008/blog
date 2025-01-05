<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
    $validator = Validator::make($request->all(), [
        'first_name' => ['required', 'string', 'max:255'],
        'middle_name' => ['nullable', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'dob' => ['required', 'date'],
        'hobbies' => ['nullable', 'array'], // Ensure it's an array
        'gender' => ['required', 'string', 'in:male,female,other'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    // If validation fails, return with errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

  

    $profileImagePath = null;

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $profileImagePath = 'profile_images/' . $image->getClientOriginalName();
        $image->move(public_path('profile_images'), $profileImagePath);
    }

    // Create the user
    $user = User::create([
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'dob' => $request->dob,
        'hobbies' => $request->hobbies ? json_encode($request->hobbies) : null, // Store hobbies as JSON
        'gender' => $request->gender,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash the password
        'profile_image' => $profileImagePath, // Store image path if present
        'role' => $request->role ?? 'user',  // Default to 'user' if no role is provided
        'status' => '1',  // Default to active status
    ]);
        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect('/admin');  // Redirect directly to /admin URL
        } else {
            return redirect()->route('dashboard');  // Redirect to user dashboard
        }
    }
}
