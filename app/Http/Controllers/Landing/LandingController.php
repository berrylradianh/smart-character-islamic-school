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

    public function profile()
    {
        $data = [
            'title' => 'Profil',
        ];

        return view('pages.landing.profile.index', $data);
    }

    public function vision()
    {
        $data = [
            'title' => 'Visi dan Misi',
        ];

        return view('pages.landing.vision.index', $data);
    }

    public function program()
    {
        $data = [
            'title' => 'Program',
        ];

        return view('pages.landing.program.index', $data);
    }
}
