<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Shopkeeper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ShopkeeperAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'logoutConfirmation']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'UserName' => 'required|string|unique:shopkeepers',
            'Password' => 'required|string|min:6|confirmed',
        ]);

        $shopkeeper = Shopkeeper::create([
            'UserName' => $request->UserName,
            'Password' => Hash::make($request->Password),
        ]);

        Auth::login($shopkeeper);

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'UserName' => 'required|string',
            'Password' => 'required|string',
        ]);

        if (Auth::attempt(['UserName' => $credentials['UserName'], 'password' => $credentials['Password']])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'UserName' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('Password'));
    }

    public function logoutConfirmation()
    {
        return view('auth.logout-confirmation');
    }

    public function logout(Request $request)
    {
        // Get username before logout for message
        $username = Auth::user()->UserName;

        // Clear all session data
        Session::flush();
        
        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Flash success message
        Session::flash('success', "Goodbye, {$username}! You have been successfully logged out.");

        return redirect('/')->with('status', 'You have been successfully logged out');
    }
}
