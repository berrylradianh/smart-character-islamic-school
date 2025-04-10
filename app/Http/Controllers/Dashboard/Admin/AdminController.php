<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'file' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $heroData = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('heroes', 'public');
            $heroData['image'] = $imagePath;
        }

        Hero::create($heroData);

        return redirect()->back()->with('success', 'Hero section added successfully!');
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'file' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $newsData = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ];

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('news_images', 'public');
            $newsData['image'] = $filePath;
        }

        News::create($newsData);

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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'file' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $agendaData = [
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
        ];

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('agenda_images', 'public');
            $agendaData['image'] = $filePath;
        }

        Agenda::create($agendaData);

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
        $data = [
            'title' => 'PPDB FAQs',
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
