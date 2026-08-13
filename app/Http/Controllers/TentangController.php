<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentang = Tentang::latest()->get();
        return view('tentang.index', compact('tentang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tentang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    $gambarPath = null;

    if ($request->hasFile('gambar')) {

        $file = $request->file('gambar');
        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(
            public_path('uploads/tentang'),
            $namaFile
        );

        $gambarPath = 'uploads/tentang/'.$namaFile;
    }

    Tentang::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'gambar' => $gambarPath
    ]);

    return redirect()->route('tentang.index')
        ->with('success', 'Berhasil ditambahkan');
}
    /**
     * Display the specified resource.
     */
    public function show(Tentang $tentang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $tentang = Tentang::findOrFail($id);
        return view('tentang.edit', compact('tentang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $tentang = Tentang::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    $gambarPath = $tentang->gambar;

    if ($request->hasFile('gambar')) {

        // Hapus gambar lama
        if ($tentang->gambar && file_exists(public_path($tentang->gambar))) {
            unlink(public_path($tentang->gambar));
        }

        // Upload gambar baru
        $file = $request->file('gambar');
        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(
            public_path('uploads/tentang'),
            $namaFile
        );

        $gambarPath = 'uploads/tentang/'.$namaFile;
    }

    $tentang->update([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'gambar' => $gambarPath
    ]);

    return redirect()
        ->route('tentang.index')
        ->with('success', 'Data berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $tentang = Tentang::findOrFail($id);

    if ($tentang->gambar && file_exists(public_path($tentang->gambar))) {
        unlink(public_path($tentang->gambar));
    }

    $tentang->delete();

    return redirect()
        ->route('tentang.index')
        ->with('success', 'Data berhasil dihapus');
}
}
