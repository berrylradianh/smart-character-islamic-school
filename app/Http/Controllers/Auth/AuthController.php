<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            Log::info('Login attempt', ['email' => $request->email, 'has_csrf' => $request->has('_token')]);

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ], [
                'email.required' => 'Harap isi bidang ini',
                'email.email' => 'Harap masukkan alamat email yang valid',
                'password.required' => 'Harap isi bidang ini',
            ]);

            if ($validator->fails()) {
                Log::info('Validation failed', ['errors' => $validator->errors()->toArray()]);
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $request->has('remember'))) {
                $request->session()->regenerate();
                Log::info('Login successful', ['email' => $request->email]);
                return redirect()->route('dashboard.index')
                    ->with('success', 'Login successful!');
            }

            Log::info('Invalid credentials', ['email' => $request->email]);
            return redirect()->back()->withErrors(['email' => 'These credentials do not match our record.'])->withInput();
        }

        Log::info('Rendering login page');
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
                'level_id' => 'required|exists:levels,id', // Validasi level_id
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
                'level_id' => $request->level_id,
                'role_id' => 3, // Default role_id
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
