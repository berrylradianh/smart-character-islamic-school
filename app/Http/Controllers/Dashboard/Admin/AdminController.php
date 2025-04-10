<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Faqs;
use App\Models\Hero;
use App\Models\News;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'heroes' => Hero::all(),
        ];

        return view('pages.dashboard.admin.hero', $data);
    }

    public function storeHero(Request $request)
    {
        $request->validate([
            'heroes.*.title' => 'required|string|max:255',
            'heroes.*.description' => 'required|string|max:255',
            'heroes.*.file' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($request->has('heroes')) {
            foreach ($request->heroes as $index => $heroData) {
                $data = [
                    'title' => $heroData['title'],
                    'description' => $heroData['description'],
                ];

                if ($request->hasFile("heroes.{$index}.file")) {
                    $imagePath = $request->file("heroes.{$index}.file")->store('heroes', 'public');
                    $data['image'] = $imagePath;
                }

                Hero::create($data);
            }
        }

        return redirect()->back()->with('success', 'Hero sections added successfully!');
    }

    public function destroyHero($id)
    {
        $hero = Hero::findOrFail($id);
        if ($hero->image) {
            Storage::disk('public')->delete($hero->image);
        }
        $hero->delete();

        return redirect()->back()->with('success', 'Hero section removed successfully!');
    }

    public function news()
    {
        $data = [
            'title' => 'Content Berita',
            'news' => News::all(),
        ];

        return view('pages.dashboard.admin.news', $data);
    }

    public function storeNews(Request $request)
    {
        $request->validate([
            'news.*.title' => 'required|string|max:255',
            'news.*.description' => 'required|string',
            'news.*.date' => 'required|date',
            'news.*.file' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($request->has('news')) {
            foreach ($request->news as $index => $newsData) {
                $data = [
                    'title' => $newsData['title'],
                    'description' => $newsData['description'],
                    'date' => $newsData['date'],
                ];

                if ($request->hasFile("news.{$index}.file")) {
                    $filePath = $request->file("news.{$index}.file")->store('news_images', 'public');
                    $data['image'] = $filePath;
                }

                News::create($data);
            }
        }

        return redirect()->route('admin.news')->with('success', 'Berita berhasil ditambahkan!');
    }
    public function destroyNews($id)
    {
        $news = News::findOrFail($id);
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();

        return redirect()->back()->with('success', 'News section removed successfully!');
    }

    public function agenda()
    {
        $data = [
            'title' => 'Content Agenda',
            'agendas' => Agenda::orderBy('date', 'desc')->get(),
        ];

        return view('pages.dashboard.admin.agenda', $data);
    }

    public function storeAgenda(Request $request)
    {
        $request->validate([
            'agendas.*.title' => 'required|string|max:255',
            'agendas.*.description' => 'required|string',
            'agendas.*.date' => 'required|date',
            'agendas.*.file' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($request->has('agendas')) {
            foreach ($request->agendas as $index => $agendaData) {
                $data = [
                    'title' => $agendaData['title'],
                    'description' => $agendaData['description'],
                    'date' => $agendaData['date'],
                ];

                if ($request->hasFile("agendas.{$index}.file")) {
                    $filePath = $request->file("agendas.{$index}.file")->store('agenda_images', 'public');
                    $data['image'] = $filePath;
                }

                Agenda::create($data);
            }
        }

        return redirect()->route('admin.agenda')->with('success', 'Agenda berhasil ditambahkan!');
    }

    public function destroyAgenda($id)
    {
        $agenda = Agenda::findOrFail($id);
        Storage::disk('public')->delete($agenda->image);
        $agenda->delete();

        return redirect()->route('admin.agenda')->with('success', 'Agenda berhasil dihapus.');
    }

    public function ppdb_info()
    {
        $data = [
            'title' => 'PPDB Informasi',
        ];

        return view('pages.dashboard.admin.ppdb.information', $data);
    }

    public function ppdb_timeline()
    {
        $data = [
            'title' => 'PPDB Timeline',
        ];

        return view('pages.dashboard.admin.ppdb.timeline', $data);
    }

    public function ppdb_faq()
    {
        $faqs = Faqs::orderBy('order_number')->get();

        $data = [
            'title' => 'PPDB FAQs',
            'faqs' => $faqs
        ];

        return view('pages.dashboard.admin.ppdb.faq', $data);
    }

    public function ppdb_pendaftaran()
    {
        $data = [
            'title' => 'PPDB Pendaftaran',
        ];

        return view('pages.dashboard.admin.ppdb.pendaftaran', $data);
    }

    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'jenjang' => 'required|in:tk,sd,smp,sma',
            'nama_anak' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255',
            'no_hp_orang_tua' => 'required|regex:/^[0-9]{10,13}$/',
            'tanggal_lahir' => 'required|date',
            'kk' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'akta' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'pasfoto' => 'required|file|mimes:jpg,png|max:2048',
            'piagam' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'bukti_pembayaran' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'ijazah' => 'required_if:jenjang,smp,sma|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $kkPath = $request->file('kk')->store('registrations/kk', 'public');
        $aktaPath = $request->file('akta')->store('registrations/akta', 'public');
        $pasfotoPath = $request->file('pasfoto')->store('registrations/pasfoto', 'public');
        $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('registrations/bukti_pembayaran', 'public');
        $piagamPath = $request->hasFile('piagam') ? $request->file('piagam')->store('registrations/piagam', 'public') : null;
        $ijazahPath = $request->hasFile('ijazah') ? $request->file('ijazah')->store('registrations/ijazah', 'public') : null;

        Registration::create([
            'jenjang' => $request->jenjang,
            'nama_anak' => $request->nama_anak,
            'nama_orang_tua' => $request->nama_orang_tua,
            'no_hp_orang_tua' => $request->no_hp_orang_tua,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kk_path' => $kkPath,
            'akta_path' => $aktaPath,
            'pasfoto_path' => $pasfotoPath,
            'piagam_path' => $piagamPath,
            'bukti_pembayaran_path' => $buktiPembayaranPath,
            'ijazah_path' => $ijazahPath,
        ]);

        return redirect()->route('admin.ppdb_pendaftaran')->with('success', 'Pendaftaran berhasil disimpan!');
    }
}
