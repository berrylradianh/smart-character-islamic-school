<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Beranda',
        ];

        return view('pages.landing.home.index', $data);
    }
}
