<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua category biar ditampili di dropdown form tambah
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dolo
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // mastiin klo category_id ada di tabel categories, kalo misal gaada 
            'photo'=>'nullable|image|mimes:jpeg,png,jpg|max:2048' //maksimal 2mb dan hanya format gambar yang diterima
        ]);

        $data = $request->all();
        // Assign author secara otomatis berdsaarkan user yang sedang login (alias pengirim article baru ini)
        $data['author_id'] = Auth::id();

        // Kalau ada file foot yang diupload, ini handlernya
        if ($request->hasFile('photo')){
            // function store() nanti bakal scr otomatis simpen ke folder storage/app/public/articles
            // dan otomatis bikin link simbolik ke public/articles
            $data['photo'] = $request->file('photo')->store('articles', 'public'); // articles  = nama folder, public = disk yang dipake
        }

        // Simpen data article baru ke database
        Article::create($data);

        // Redirect ke halaman admin articles
        return redirect()->route('admin.articles.index')->with('success', 'Article berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $article = Article::with('author', 'category')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data article yang mau diedit
        $article = Article::findOrFail($id);
        // Ambil semua category biar bisa dipilih di dropdown
        $categories = Category::all();
        // Tampilin form edit
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // make sure kalau yang edit itu admin atau author dari article aja
        // kalau bukan admin atau author, redirect ke halaman admin articles dengan error 403 dan pesan errornya
        $article = Article::findOrFail($id);
        if (Auth::id() !== $article->author_id && Auth::user()->role !== 'admin') {
            return abort(403, 'Anda tidak memiliki akses untuk mengedit article ini!');
        }
        // validasi dulu kek biasanya
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Ambil article yang mau diupdate
        $article = Article::findOrFail($id);
        $data = $request->all();

        // Kalau ada foto baru yang diupload, handle di sini
        if ($request->hasFile('photo')) {
            // Kalau sebelumnya udah ada foto, hapus dulu foto lamanya
            if ($article->photo && Storage::disk('public')->exists($article->photo)) {
                Storage::disk('public')->delete($article->photo);
            }
            // Upload foto baru
            $data['photo'] = $request->file('photo')->store('articles', 'public');
        }

        // Update data article
        $article->update($data);

        // Redirect ke halaman admin articles
        return redirect()->route('admin.articles.index')->with('success', 'Article berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // make sure kalau yang menghapus itu admin atau author dari article
        // kalau bukan admin atau author, redirect ke halaman admin articles dengan error 403 dan pesan errornya
        $article = Article::findOrFail($id);
        if (Auth::id() !== $article->author_id && Auth::user()->role !== 'admin') {
            return abort(403, 'Anda tidak memiliki akses untuk menghapus article ini!');
        }
        // hapus foto article kalau ada
        if ($article->photo && Storage::disk('public')->exists($article->photo)) {
            Storage::disk('public')->delete($article->photo);
        }
        // hapus article
        $article->delete();
        // redirect ke halaman admin articles
        return redirect()->route('admin.articles.index')->with('success', 'Article berhasil dihapus!');
    }

    public function adminIndex(){
        // latest() biar urut dari yang terbaru
        // pakai author dan category biar bisa ngambil nama author dan category
        $articles = Article::with(['author', 'category'])->latest()->paginate(10); 
        return view('admin.articles.index', compact('articles'));
    }
    
}
