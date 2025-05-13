<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Mail\PpdbInquiry;
use App\Models\Agenda;
use App\Models\DashboardStat;
use App\Models\Hero;
use App\Models\Introduction;
use App\Models\News;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index()
    {
        $introduction = Introduction::first() ?? new Introduction(['content' => '', 'image' => null]);
        $data = [
            'title' => 'Beranda',
            'heroes' => Hero::all(),
            'news' => News::orderBy('date', 'desc')->get(),
            'agendas' => Agenda::orderBy('date', 'desc')->get(),
            'stats' => DashboardStat::all(),
            'values' => Value::all(),
            'introduction' => Introduction::first() ? Introduction::first()->content : '',
            'introduction_image' => $introduction->image,
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

    public function ppdb(Request $request)
    {
        $data = [
            'title' => 'PPDB',
        ];

        if ($request->isMethod('post')) {
            $emailData = [
                'namaSiswa' => $request->namaSiswa,
                'asalSekolah' => $request->asalSekolah,
                'namaOrangTua' => $request->namaOrangTua,
                'nomorHP' => $request->nomorHP,
                'email' => $request->email,
                'jenjang' => $request->jenjang,
                'pesan' => $request->pesan,
            ];

            try {
                Mail::to('berrylhamesha@gmail.com')->send(new PpdbInquiry($emailData));
                return redirect()->route('ppdb')->with('success', 'Pertanyaan Anda telah berhasil dikirim!');
            } catch (\Exception $e) {
                return redirect()->route('ppdb')->with('error', 'Gagal mengirim email: ' . $e->getMessage());
            }
        }

        return view('pages.landing.ppdb.index', $data);
    }

    public function search(Request $request)
    {
        $query = strtolower(trim($request->input('query')));

        $menus = [
            ['title' => 'Beranda', 'route' => 'landing.home', 'keywords' => ['beranda', 'home']],
            ['title' => 'Profil', 'route' => 'landing.profile', 'keywords' => ['profil', 'profile', 'tentang kami']],
            ['title' => 'Visi dan Misi', 'route' => 'landing.vision', 'keywords' => ['visi', 'misi', 'vision', 'mission', 'tentang kami']],
            ['title' => 'Program', 'route' => 'landing.program', 'keywords' => ['program', 'kegiatan', 'aktivitas']],
            ['title' => 'PPDB', 'route' => 'ppdb', 'keywords' => ['ppdb', 'pendaftaran', 'siswa baru']],
        ];

        $results = [];

        foreach ($menus as $menu) {
            foreach ($menu['keywords'] as $keyword) {
                if (str_contains(strtolower($keyword), $query)) {
                    $results[] = [
                        'title' => $menu['title'],
                        'url' => route($menu['route']),
                    ];
                    break;
                }
            }
        }

        if (empty($results)) {
            return view('pages.landing.search.index', [
                'title' => 'Hasil Pencarian',
                'query' => $query,
                'results' => [],
                'message' => 'Tidak ada hasil yang ditemukan untuk "' . $query . '"',
            ]);
        }

        return view('pages.landing.search.index', [
            'title' => 'Hasil Pencarian',
            'query' => $query,
            'results' => $results,
        ]);
    }

    public function searchSuggestions(Request $request)
    {
        $query = strtolower(trim($request->input('query')));

        $menus = [
            ['title' => 'Beranda', 'route' => 'landing.home', 'keywords' => ['beranda', 'home']],
            ['title' => 'Profil', 'route' => 'landing.profile', 'keywords' => ['profil', 'profile', 'tentang kami']],
            ['title' => 'Visi dan Misi', 'route' => 'landing.vision', 'keywords' => ['visi', 'misi', 'vision', 'mission', 'tentang kami']],
            ['title' => 'Program', 'route' => 'landing.program', 'keywords' => ['program', 'kegiatan', 'aktivitas']],
            ['title' => 'PPDB', 'route' => 'ppdb', 'keywords' => ['ppdb', 'pendaftaran', 'siswa baru']],
        ];

        $suggestions = [];

        if (!empty($query)) {
            foreach ($menus as $menu) {
                foreach ($menu['keywords'] as $keyword) {
                    if (str_contains(strtolower($keyword), $query)) {
                        $suggestions[] = [
                            'title' => $menu['title'],
                            'url' => route($menu['route']),
                        ];
                        break;
                    }
                }
            }
        }

        return response()->json($suggestions);
    }
}
