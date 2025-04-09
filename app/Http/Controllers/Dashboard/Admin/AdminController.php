<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\News;
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
}
