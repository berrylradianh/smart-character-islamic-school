<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->has('remember'))) {
                $request->session()->regenerate();
                return redirect()->route('admin.index')
                    ->with('success', 'Login successful!');
            }

            return redirect()->back()
                ->withErrors(['email' => 'The provided credentials do not match our records.'])
                ->withInput();
        }

        return view('pages.landing.auth.login', [
            'title' => 'Login',
        ]);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'jenjang' => 'nullable|in:sd,smp,sma,kuliah',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jenjang' => $request->jenjang ?? null,
            ]);

            Auth::login($user);

            return redirect()->route('profile.show')
                ->with('success', 'Registration successful! Welcome to your profile.');
        }

        return view('pages.landing.auth.register', [
            'title' => 'Register',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
