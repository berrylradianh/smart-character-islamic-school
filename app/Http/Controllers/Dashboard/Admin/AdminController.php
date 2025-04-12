<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\DashboardStat;
use App\Models\Faqs;
use App\Models\Hero;
use App\Models\Level;
use App\Models\News;
use App\Models\Registration;
use App\Models\RegistrationInfo;
use App\Models\SchoolLocation;
use App\Models\Timeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = [
            'title' => 'Dashboard Admin',
            'stats' => DashboardStat::all(),
            'user' => $user,
        ];

        return view('pages.dashboard.admin.index', $data);
    }

    public function stats()
    {
        $stats = DashboardStat::all();
        $user = Auth::user();


        $data = [
            'title' => 'Manage Dashboard Stats',
            'stats' => $stats,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.stats', $data);
    }

    public function storeStat(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|integer',
            'previous_period_percentage' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'color' => 'nullable|string',
            'progress_bar_color' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('dashboard/icons', 'public');
        }

        DashboardStat::create($data);

        return redirect()->route('admin.stats')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function updateStat(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|integer',
            'previous_period_percentage' => 'required|integer|min:0|max:100',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'color' => 'nullable|string',
            'progress_bar_color' => 'nullable|string',
        ]);

        $stat = DashboardStat::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('icon')) {
            if ($stat->icon) {
                Storage::disk('public')->delete($stat->icon);
            }
            $data['icon'] = $request->file('icon')->store('dashboard/icons', 'public');
        }

        $stat->update($data);

        return redirect()->route('admin.stats')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroyStat($id)
    {
        $stat = DashboardStat::findOrFail($id);

        if ($stat->icon) {
            storage::disk('public')->delete($stat->icon);
        }

        $stat->delete();

        return redirect()->route('admin.stats')->with('success', 'Statistik berhasil dihapus.');
    }

    public function hero()
    {
        $user = Auth::user();

        $data = [
            'title' => 'Content Hero',
            'heroes' => Hero::all(),
            'user' => $user,
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
        $user = Auth::user();

        $data = [
            'title' => 'Content Berita',
            'news' => News::all(),
            'user' => $user,
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
        $user = Auth::user();

        $data = [
            'title' => 'Content Agenda',
            'agendas' => Agenda::orderBy('date', 'desc')->get(),
            'user' => $user,
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
        $user = Auth::user();
        $registrationInfos = RegistrationInfo::with('level')->get()->keyBy('level.slug');
        $levels = Level::all();
        $data = [
            'title' => 'PPDB Informasi',
            'registrationInfos' => $registrationInfos,
            'levels' => $levels,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.information', $data);
    }

    public function requirement_information()
    {
        $user = Auth::user();
        $registrationInfos = RegistrationInfo::with('level')->get();
        // Get levels that do not have associated registration info
        $usedLevelIds = RegistrationInfo::pluck('level_id')->toArray();
        $availableLevels = Level::whereNotIn('id', $usedLevelIds)->get();
        $levels = Level::all(); // For displaying all levels in the jenjang table
        $data = [
            'title' => 'Kelola Informasi Pendaftaran',
            'registrationInfos' => $registrationInfos,
            'availableLevels' => $availableLevels,
            'levels' => $levels,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.requirement_information', $data);
    }

    public function storeRequirementInformation(Request $request)
    {
        $validated = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'requirements' => 'required|array',
            'requirements.*' => 'string',
            'stages' => 'required|array',
            'stages.*' => 'string',
            'fees' => 'required|array',
            'fees.*' => 'string',
        ]);

        // Ensure level_id doesn't already have registration info
        if (RegistrationInfo::where('level_id', $validated['level_id'])->exists()) {
            return redirect()->back()->withErrors(['level_id' => 'Jenjang ini sudah memiliki informasi pendaftaran.']);
        }

        RegistrationInfo::create([
            'level_id' => $validated['level_id'],
            'requirements' => $validated['requirements'],
            'stages' => $validated['stages'],
            'fees' => $validated['fees'],
        ]);

        return redirect()->route('admin.requirement_information')->with('success', 'Informasi pendaftaran berhasil disimpan.');
    }

    public function editRequirementInformation($id)
    {
        $user = Auth::user();
        $registrationInfo = RegistrationInfo::with('level')->findOrFail($id);
        // Get levels that are either the current level or have no registration info
        $usedLevelIds = RegistrationInfo::where('id', '!=', $id)->pluck('level_id')->toArray();
        $availableLevels = Level::whereNotIn('id', $usedLevelIds)->orWhere('id', $registrationInfo->level_id)->get();
        $data = [
            'title' => 'Edit Informasi Pendaftaran',
            'registrationInfo' => $registrationInfo,
            'availableLevels' => $availableLevels,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.requirement_information_edit', $data);
    }

    public function updateRequirementInformation(Request $request, $id)
    {
        $registrationInfo = RegistrationInfo::findOrFail($id);

        $validated = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'requirements' => 'required|array',
            'requirements.*' => 'string',
            'stages' => 'required|array',
            'stages.*' => 'string',
            'fees' => 'required|array',
            'fees.*' => 'string',
        ]);

        // Ensure level_id isn't taken by another registration info
        if (RegistrationInfo::where('level_id', $validated['level_id'])->where('id', '!=', $id)->exists()) {
            return redirect()->back()->withErrors(['level_id' => 'Jenjang ini sudah memiliki informasi pendaftaran.']);
        }

        $registrationInfo->update([
            'level_id' => $validated['level_id'],
            'requirements' => $validated['requirements'],
            'stages' => $validated['stages'],
            'fees' => $validated['fees'],
        ]);

        return redirect()->route('admin.requirement_information')->with('success', 'Informasi pendaftaran berhasil diperbarui.');
    }

    public function destroyRequirementInformation($id)
    {
        $info = RegistrationInfo::findOrFail($id);
        $info->delete();

        return redirect()->route('admin.requirement_information')->with('success', 'Informasi pendaftaran berhasil dihapus.');
    }

    public function storeLevel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:levels,slug',
        ]);

        Level::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
        ]);

        return redirect()->route('admin.requirement_information')->with('success', 'Jenjang berhasil ditambahkan.');
    }

    public function destroyLevel($id)
    {
        $level = Level::findOrFail($id);
        $level->delete(); // Cascade will delete related registration_infos

        return redirect()->route('admin.requirement_information')->with('success', 'Jenjang berhasil dihapus.');
    }

    public function ppdb_timeline()
    {
        $user = Auth::user();
        $levels = Level::with('timelines')->get();
        $data = [
            'title' => 'PPDB Timeline',
            'levels' => $levels,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.timeline', $data);
    }

    public function requirement_timeline()
    {
        $user = Auth::user();
        $timelines = Timeline::with('level')->get()->groupBy('level_id');
        // Get levels that do not have timelines
        $usedLevelIds = Timeline::pluck('level_id')->unique()->toArray();
        $availableLevels = Level::whereNotIn('id', $usedLevelIds)->get();
        $levels = Level::all(); // For displaying all levels in the list
        $data = [
            'title' => 'Kelola Timeline Pendaftaran',
            'timelines' => $timelines,
            'availableLevels' => $availableLevels,
            'levels' => $levels,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.requirement_timeline', $data);
    }

    public function storeTimeline(Request $request)
    {
        $validated = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'timelines' => 'required|array',
            'timelines.*.title' => 'required|string|max:255',
            'timelines.*.description' => 'required|string',
            'timelines.*.date_range' => 'required|string|max:255',
        ]);

        // Prevent adding timelines if the level already has them
        if (Timeline::where('level_id', $validated['level_id'])->exists()) {
            return redirect()->back()->withErrors(['level_id' => 'Jenjang ini sudah memiliki timeline. Gunakan edit atau tambah di daftar untuk mengubah.']);
        }

        // Create new timelines
        foreach ($validated['timelines'] as $timeline) {
            Timeline::create([
                'level_id' => $validated['level_id'],
                'title' => $timeline['title'],
                'description' => $timeline['description'],
                'date_range' => $timeline['date_range'],
            ]);
        }

        return redirect()->route('admin.requirement_timeline')->with('success', 'Timeline pendaftaran berhasil disimpan.');
    }

    public function addTimeline(Request $request)
    {
        $validated = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_range' => 'required|string|max:255',
        ]);

        Timeline::create([
            'level_id' => $validated['level_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date_range' => $validated['date_range'],
        ]);

        return redirect()->route('admin.requirement_timeline')->with('success', 'Timeline baru berhasil ditambahkan ke jenjang.');
    }

    public function editTimeline($id)
    {
        $user = Auth::user();
        $timeline = Timeline::findOrFail($id);
        $data = [
            'title' => 'Edit Timeline Pendaftaran',
            'timeline' => $timeline,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.requirement_timeline_edit', $data);
    }

    public function updateTimeline(Request $request, $id)
    {
        $timeline = Timeline::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date_range' => 'required|string|max:255',
        ]);

        $timeline->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date_range' => $validated['date_range'],
        ]);

        return redirect()->route('admin.requirement_timeline')->with('success', 'Timeline pendaftaran berhasil diperbarui.');
    }

    public function destroyTimeline($id)
    {
        $timeline = Timeline::findOrFail($id);
        $timeline->delete();

        return redirect()->route('admin.requirement_timeline')->with('success', 'Timeline pendaftaran berhasil dihapus.');
    }

    public function ppdb_faq()
    {
        $faqs = Faqs::orderBy('order_number')->get();
        $user = Auth::user();

        $data = [
            'title' => 'PPDB FAQs',
            'faqs' => $faqs,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.faq', $data);
    }

    public function requirementFaq()
    {
        $user = Auth::user();
        $faqs = Faqs::orderBy('order_number')->get();

        $data = [
            'title' => 'Kelola FAQs',
            'faqs' => $faqs,
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.requirement_faq', $data);
    }

    public function storeFaq(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order_number' => 'required|integer|min:1',
            'category_color' => 'required|in:success,primary,warning,danger,info',
        ]);

        Faqs::create($validated);

        return redirect()->route('admin.requirement_faq')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function updateFaq(Request $request, $id)
    {
        $faq = Faqs::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order_number' => 'required|integer|min:1',
            'category_color' => 'required|in:success,primary,warning,danger,info',
        ]);

        $faq->update($validated);

        return redirect()->route('admin.requirement_faq')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroyFaq($id)
    {
        $faq = Faqs::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.requirement_faq')->with('success', 'FAQ berhasil dihapus.');
    }

    public function ppdb_pendaftaran()
    {
        $user = Auth::user();
        $data = [
            'title' => 'PPDB Pendaftaran',
            'user' => $user,
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

    public function listPendaftar()
    {
        $user = Auth::user();
        $data = [
            'title' => 'PPDB List Pendaftar',
            'registrations' => Registration::with('schoolLocation')->get(),
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.list', $data);
    }

    public function showPendaftar($id)
    {
        $user = Auth::user();
        $data = [
            'title' => 'PPDB List Pendaftar',
            'registration' => Registration::with('schoolLocation')->findOrFail($id),
            'locations' => SchoolLocation::all(),
            'user' => $user,
        ];

        return view('pages.dashboard.admin.ppdb.detail', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:waiting,decline,approve',
                'jadwal_tes' => 'nullable|required_if:status,approve|date',
                'school_location_id' => 'nullable|required_if:status,approve|exists:school_locations,id',
            ]);

            $registration = Registration::findOrFail($id);
            $data = ['status' => $request->status];

            if ($request->status === 'approve') {
                $data['jadwal_tes'] = $request->jadwal_tes;
                $data['school_location_id'] = $request->school_location_id;
            } else {
                $data['jadwal_tes'] = null;
                $data['school_location_id'] = null;
            }

            $registration->update($data);

            return redirect()->route('admin.list_pendaftar')->with('success', 'Status berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function export($format)
    {
        $registrations = Registration::with('schoolLocation')->get();

        if ($format === 'pdf') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.dashboard.admin.ppdb.registrations_pdf', compact('registrations'));
            return $pdf->download('daftar_pendaftar_' . now()->format('Ymd_His') . '.pdf');
        } elseif ($format === 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\RegistrationsExport, 'daftar_pendaftar_' . now()->format('Ymd_His') . '.xlsx');
        }

        return redirect()->back()->with('error', 'Format ekspor tidak valid.');
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('pages.dashboard.admin.profile', [
            'title' => 'Profil Pengguna',
            'user' => $user,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('pages.dashboard.admin.profile_edit', [
            'title' => 'Edit Profil',
            'user' => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp_orang_tua' => 'nullable|string|max:15',
            'jenjang' => 'nullable|in:sd,smp,sma,kuliah',
            'kk_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'akta_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'pasfoto_path' => 'nullable|file|mimes:jpg,png|max:2048',
            'ijazah_sd_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah_smp_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah_sma_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'piagam_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;
        $user->nama_orang_tua = $request->nama_orang_tua;
        $user->no_hp_orang_tua = $request->no_hp_orang_tua;
        $user->jenjang = $request->jenjang;

        // Handle file uploads
        if ($request->hasFile('kk_path')) {
            if ($user->kk_path) {
                Storage::disk('public')->delete($user->kk_path);
            }
            $user->kk_path = $request->file('kk_path')->store('documents/kk', 'public');
        }

        if ($request->hasFile('akta_path')) {
            if ($user->akta_path) {
                Storage::disk('public')->delete($user->akta_path);
            }
            $user->akta_path = $request->file('akta_path')->store('documents/akta', 'public');
        }

        if ($request->hasFile('pasfoto_path')) {
            if ($user->pasfoto_path) {
                Storage::disk('public')->delete($user->pasfoto_path);
            }
            $user->pasfoto_path = $request->file('pasfoto_path')->store('documents/pasfoto', 'public');
        }

        if ($request->hasFile('ijazah_sd_path')) {
            if ($user->ijazah_sd_path) {
                Storage::disk('public')->delete($user->ijazah_sd_path);
            }
            $user->ijazah_sd_path = $request->file('ijazah_sd_path')->store('documents/ijazah_sd', 'public');
        }

        if ($request->hasFile('ijazah_smp_path')) {
            if ($user->ijazah_smp_path) {
                Storage::disk('public')->delete($user->ijazah_smp_path);
            }
            $user->ijazah_smp_path = $request->file('ijazah_smp_path')->store('documents/ijazah_smp', 'public');
        }

        if ($request->hasFile('ijazah_sma_path')) {
            if ($user->ijazah_sma_path) {
                Storage::disk('public')->delete($user->ijazah_sma_path);
            }
            $user->ijazah_sma_path = $request->file('ijazah_sma_path')->store('documents/ijazah_sma', 'public');
        }

        if ($request->hasFile('piagam_path')) {
            if ($user->piagam_path) {
                Storage::disk('public')->delete($user->piagam_path);
            }
            $user->piagam_path = $request->file('piagam_path')->store('documents/piagam', 'public');
        }

        $user->save();

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    public function listUsers()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Daftar Pengguna',
            'users' => User::all(),
            'user' => $user,
        ];

        return view('pages.dashboard.admin.users.index', $data);
    }

    public function createUser()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Tambah Pengguna',
            'user' => $user,
        ];

        return view('pages.dashboard.admin.users.create', $data);
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|regex:/^[0-9]{10,13}$/',
            'alamat' => 'nullable|string',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp_orang_tua' => 'nullable|regex:/^[0-9]{10,13}$/',
            'jenjang' => 'nullable|in:tk,sd,smp,sma,kuliah',
            'kk_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'akta_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'pasfoto_path' => 'nullable|file|mimes:jpg,png|max:2048',
            'ijazah_sd_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah_smp_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah_sma_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'piagam_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
            'nama_orang_tua' => $validated['nama_orang_tua'],
            'no_hp_orang_tua' => $validated['no_hp_orang_tua'],
            'jenjang' => $validated['jenjang'],
        ];

        // Handle file uploads
        if ($request->hasFile('kk_path')) {
            $data['kk_path'] = $request->file('kk_path')->store('documents/kk', 'public');
        }
        if ($request->hasFile('akta_path')) {
            $data['akta_path'] = $request->file('akta_path')->store('documents/akta', 'public');
        }
        if ($request->hasFile('pasfoto_path')) {
            $data['pasfoto_path'] = $request->file('pasfoto_path')->store('documents/pasfoto', 'public');
        }
        if ($request->hasFile('ijazah_sd_path')) {
            $data['ijazah_sd_path'] = $request->file('ijazah_sd_path')->store('documents/ijazah_sd', 'public');
        }
        if ($request->hasFile('ijazah_smp_path')) {
            $data['ijazah_smp_path'] = $request->file('ijazah_smp_path')->store('documents/ijazah_smp', 'public');
        }
        if ($request->hasFile('ijazah_sma_path')) {
            $data['ijazah_sma_path'] = $request->file('ijazah_sma_path')->store('documents/ijazah_sma', 'public');
        }
        if ($request->hasFile('piagam_path')) {
            $data['piagam_path'] = $request->file('piagam_path')->store('documents/piagam', 'public');
        }

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function showUser($id)
    {
        $user = Auth::user();
        $data = [
            'title' => 'Detail Pengguna',
            'user' => $user,
            'selectedUser' => User::findOrFail($id),
        ];

        return view('pages.dashboard.admin.users.show', $data);
    }

    public function editUser($id)
    {
        $user = Auth::user();
        $data = [
            'title' => 'Edit Pengguna',
            'user' => $user,
            'selectedUser' => User::findOrFail($id),
        ];

        return view('pages.dashboard.admin.users.edit', $data);
    }

    public function updateUser(Request $request, $id)
    {
        $selectedUser = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|regex:/^[0-9]{10,13}$/',
            'alamat' => 'nullable|string',
            'nama_orang_tua' => 'nullable|string|max:255',
            'no_hp_orang_tua' => 'nullable|regex:/^[0-9]{10,13}$/',
            'jenjang' => 'nullable|in:tk,sd,smp,sma,kuliah',
            'kk_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'akta_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'pasfoto_path' => 'nullable|file|mimes:jpg,png|max:2048',
            'ijazah_sd_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah_smp_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'ijazah_sma_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'piagam_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
            'nama_orang_tua' => $validated['nama_orang_tua'],
            'no_hp_orang_tua' => $validated['no_hp_orang_tua'],
            'jenjang' => $validated['jenjang'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        // Handle file uploads and delete old files if new ones are uploaded
        if ($request->hasFile('kk_path')) {
            if ($selectedUser->kk_path) {
                Storage::disk('public')->delete($selectedUser->kk_path);
            }
            $data['kk_path'] = $request->file('kk_path')->store('documents/kk', 'public');
        }
        if ($request->hasFile('akta_path')) {
            if ($selectedUser->akta_path) {
                Storage::disk('public')->delete($selectedUser->akta_path);
            }
            $data['akta_path'] = $request->file('akta_path')->store('documents/akta', 'public');
        }
        if ($request->hasFile('pasfoto_path')) {
            if ($selectedUser->pasfoto_path) {
                Storage::disk('public')->delete($selectedUser->pasfoto_path);
            }
            $data['pasfoto_path'] = $request->file('pasfoto_path')->store('documents/pasfoto', 'public');
        }
        if ($request->hasFile('ijazah_sd_path')) {
            if ($selectedUser->ijazah_sd_path) {
                Storage::disk('public')->delete($selectedUser->ijazah_sd_path);
            }
            $data['ijazah_sd_path'] = $request->file('ijazah_sd_path')->store('documents/ijazah_sd', 'public');
        }
        if ($request->hasFile('ijazah_smp_path')) {
            if ($selectedUser->ijazah_smp_path) {
                Storage::disk('public')->delete($selectedUser->ijazah_smp_path);
            }
            $data['ijazah_smp_path'] = $request->file('ijazah_smp_path')->store('documents/ijazah_smp', 'public');
        }
        if ($request->hasFile('ijazah_sma_path')) {
            if ($selectedUser->ijazah_sma_path) {
                Storage::disk('public')->delete($selectedUser->ijazah_sma_path);
            }
            $data['ijazah_sma_path'] = $request->file('ijazah_sma_path')->store('documents/ijazah_sma', 'public');
        }
        if ($request->hasFile('piagam_path')) {
            if ($selectedUser->piagam_path) {
                Storage::disk('public')->delete($selectedUser->piagam_path);
            }
            $data['piagam_path'] = $request->file('piagam_path')->store('documents/piagam', 'public');
        }

        $selectedUser->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $selectedUser = User::findOrFail($id);

        // Prevent deleting the current user
        if ($selectedUser->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Delete associated files
        $paths = [
            'kk_path',
            'akta_path',
            'pasfoto_path',
            'ijazah_sd_path',
            'ijazah_smp_path',
            'ijazah_sma_path',
            'piagam_path',
        ];

        foreach ($paths as $path) {
            if ($selectedUser->$path) {
                Storage::disk('public')->delete($selectedUser->$path);
            }
        }

        $selectedUser->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
