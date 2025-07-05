<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Mail\PpdbInquiry;
use App\Models\Agenda;
use App\Models\DashboardStat;
use App\Models\Faqs;
use App\Models\Hero;
use App\Models\Introduction;
use App\Models\Media;
use App\Models\News;
use App\Models\Ppdb;
use App\Models\Profile;
use App\Models\Program;
use App\Models\Testimonial;
use App\Models\Value;
use App\Models\Vision;
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
            'introduction' => $introduction->content,
            'introduction_image' => $introduction->image,
            'programs' => Program::orderBy('order')->orderBy('created_at', 'desc')->take(4)->get(),
            'testimonials' => Testimonial::orderBy('order')->orderBy('created_at', 'desc')->get(),
            'media' => Media::orderBy('order')->orderBy('created_at', 'desc')->get(),
        ];

        return view('pages.landing.home.index', $data);
    }

    public function profile()
    {
        $profile = Profile::first() ?? new Profile(['title' => 'Smart Character Islamic School (SCIS)', 'content' => '', 'image' => null]);
        $data = [
            'title' => 'Profil',
            'profile' => $profile,
        ];

        return view('pages.landing.profile.index', $data);
    }

    public function vision()
    {
        $vision = Vision::first() ?? new Vision([
            'vision_text' => '"Menjadi Lembaga Kaderisasi umat yang inklusif, berkemajuan dan berwawasan global."',
            'mission_items' => [
                'SMART adalah : Specific, Measurable, Achievable, Relevant dan Timebound.',
                'Berakhlak Mulia yaitu beradab dan berbudi pekerti mulia.',
                'Disiplin Tinggi yaitu peka dan sadar dengan diri sendiri dan lingkungan sekitar.',
                'Mandiri yaitu kuat dalam ekonomi, menguasai ilmu akuntansi dan keuangan.',
                'Kompeten yaitu ahli dalam bidang tententu dan atau segala bidang.'
            ],
            'commitment_text' => 'SCIS berkomitmen untuk membentuk pendidikan yang berlandaskan pada ajaran islam.',
            'poster_image' => null,
        ]);
        $data = [
            'title' => 'Visi dan Misi',
            'vision' => $vision,
        ];

        return view('pages.landing.vision.index', $data);
    }

    public function program()
    {
        $data = [
            'title' => 'Program',
            'programs' => Program::orderBy('order')->orderBy('created_at', 'desc')->get(),
        ];

        return view('pages.landing.program.index', $data);
    }

    public function ppdb(Request $request)
    {
        $ppdb = Ppdb::first() ?? new Ppdb([
            'description' => '<strong>Smart Character Islamic School (SCIS)</strong> membuka <strong>Penerimaan Peserta Didik Baru (PPDB)</strong> untuk Tahun Ajaran 2025–2026! Kami berkomitmen mencetak generasi Qur\'ani yang cerdas, berkarakter, dan siap menghadapi tantangan zaman.',
            'program_unggulan' => [
                'Tahfizh Qur’an dan pembiasaan adab Islami',
                'Pendidikan karakter berbasis Al-Qur’an dan Hadits',
                'Bahasa Inggris dan Arab sejak dini',
                'Pembelajaran berbasis proyek dan teknologi',
                'Ekstrakurikuler Islami dan pengembangan minat bakat',
            ],
            'jenjang_pendidikan' => 'Taman Kanak-Kanak (TK), dan Sekolah Dasar (SD), Sekolah Menengah (SMP), dan Sekolah Menengah Atas (SMA)',
            'jadwal_pendaftaran' => '1 November 2024 – 30 Juni 2025',
            'contact_info' => 'WhatsApp: <a href="https://wa.me/62812XXXXXXX" target="_blank">0812-XXXX-XXXX</a>',
            'image' => null,
            'registrant_counts' => [ // Add default registrant counts
                'tk' => 35,
                'sd' => 70,
                'smp' => 40,
                'sma' => 20,
            ],
            'rincian_biaya' => [
                'Biaya Pendaftaran: Rp 500.000',
                'Uang Pangkal: Rp 5.000.000',
                'SPP Bulanan: Rp 1.000.000',
            ],
            'jadwal_ppdb' => [
                'Pendaftaran: 1 Januari 2025 - 30 Juni 2025',
                'Tes Seleksi: 1 Juli 2025 - 5 Juli 2025',
                'Pengumuman: 10 Juli 2025',
            ],
            'dokumen_diperlukan' => [
                'Fotokopi Akta Kelahiran',
                'Fotokopi Kartu Keluarga',
                'Pas Foto 3x4 (2 lembar)',
                'Surat Keterangan Sehat',
            ],
        ]);

        $faqs = Faqs::orderBy('order_number')->orderBy('created_at', 'desc')->where('show_on_landing_page', true)->get();

        $data = [
            'title' => 'PPDB',
            'faqs' => $faqs,
            'ppdb' => $ppdb,
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
                Mail::to(env('MAIL_TO_ADDRESS', 'pesantrenscis@gmail.com'))
                    ->send(new PpdbInquiry($emailData));
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
