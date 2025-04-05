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

    public function news()
    {
        $data = [
            'title' => 'Content Berita',
        ];

        return view('pages.dashboard.admin.news', $data);
    }

    public function agenda()
    {
        $data = [
            'title' => 'Content Agenda',
        ];

        return view('pages.dashboard.admin.agenda', $data);
    }

    public function ppdb_info()
    {
        $data = [
            'title' => 'PPDB Informasi',
        ];

        return view('pages.dashboard.admin.ppdb.information', $data);
    }
}
