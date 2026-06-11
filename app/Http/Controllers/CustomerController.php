<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Show the customer login form
     */
    public function login(): View
    {
        return view('customer.login');
    }

    /**
     * Handle customer login
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('website.index');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    /**
     * Show the customer registration form
     */
    public function signup(): View
    {
        return view('customer.signup');
    }

    /**
     * Handle customer registration
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('website.index');
    }

    /**
     * Show the customer dashboard
     */
    public function dashboard(): View
    {
        return view('customer.dashboard');
    }

    /**
     * Handle customer logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login');
    }
}
