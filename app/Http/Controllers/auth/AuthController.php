<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function auth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Email Or Password Are Incorrect !');
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with('error', 'Email Or Password Are Incorrect !');
        }
        Auth::login($user);
        return redirect()
            ->route($user->role === "admin"
                ? 'admin.dashboard'
                : 'dashboard');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::create(
            [...$validated, 'role' => $request->input('role') ? 'admin' : 'user']
        );
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('verification.notice');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('users.login');
    }
}
