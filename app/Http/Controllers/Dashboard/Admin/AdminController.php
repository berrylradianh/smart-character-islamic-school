<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
        ];

        return view('pages.dashboard.admin.index', $data);
    }

    public function hero()
    {
        $data = [
            'title' => 'Content Hero',
        ];

        return view('pages.dashboard.admin.hero', $data);
    }


    public function introduction()
    {
        $data = [
            'title' => 'Content Perkenalan',
        ];

        return view('pages.dashboard.admin.introduction', $data);
    }
}
