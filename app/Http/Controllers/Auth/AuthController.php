<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'title' => 'Login',
        ];

        return view('pages.landing.auth.login', $data);
    }

    public function register(Request $request)
    {
        $data = [
            'title' => 'Register',
        ];

        return view('pages.landing.auth.register', $data);
    }
}
