<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Mail\PpdbInquiry;
use App\Models\Agenda;
use App\Models\Hero;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'heroes' => Hero::all(),
            'news' => News::orderBy('date', 'desc')->get(),
            'agendas' => Agenda::orderBy('date', 'desc')->get(),
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
}
