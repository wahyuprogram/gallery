<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; // Menggunakan File facade untuk hapus gambar

class FotoController extends Controller
{
    public function index()
    {
        $fotos = Foto::join('gallery_album', 'gallery_foto.AlbumID', '=', 'gallery_album.AlbumID')
                     ->where('gallery_foto.UserID', Auth::user()->UserID)
                     ->select('gallery_foto.*', 'gallery_album.NamaAlbum')
                     ->get();

        return view('foto.index', compact('fotos'));
    }

    public function create()
    {
        $albums = Album::where('UserID', Auth::user()->UserID)->get();
        return view('foto.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'JudulFoto' => 'required|max:255',
            'DeskripsiFoto' => 'required',
            'AlbumID' => 'required',
            'LokasiFile' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Simpan gambar LANGSUNG ke folder public/fotos (Anti-error Windows)
        $image = $request->file('LokasiFile');
        $imageName = $image->hashName(); // Buat nama acak yang aman
        $image->move(public_path('fotos'), $imageName); 

        Foto::create([
            'JudulFoto' => $request->JudulFoto,
            'DeskripsiFoto' => $request->DeskripsiFoto,
            'TanggalUnggah' => date('Y-m-d'),
            'LokasiFile' => $imageName,
            'AlbumID' => $request->AlbumID,
            'UserID' => Auth::user()->UserID,
        ]);

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diunggah!');
    }

    public function edit($id)
    {
        $foto = Foto::where('FotoID', $id)->where('UserID', Auth::user()->UserID)->firstOrFail();
        $albums = Album::where('UserID', Auth::user()->UserID)->get();
        return view('foto.edit', compact('foto', 'albums'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'JudulFoto' => 'required|max:255',
            'DeskripsiFoto' => 'required',
            'AlbumID' => 'required',
            'LokasiFile' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $foto = Foto::where('FotoID', $id)->where('UserID', Auth::user()->UserID)->firstOrFail();

        if ($request->hasFile('LokasiFile')) {
            // Cek dan hapus gambar lama di folder public/fotos
            if(File::exists(public_path('fotos/' . $foto->LokasiFile))) {
                File::delete(public_path('fotos/' . $foto->LokasiFile));
            }

            // Upload gambar baru
            $image = $request->file('LokasiFile');
            $imageName = $image->hashName();
            $image->move(public_path('fotos'), $imageName);

            $foto->update([
                'JudulFoto' => $request->JudulFoto,
                'DeskripsiFoto' => $request->DeskripsiFoto,
                'LokasiFile' => $imageName,
                'AlbumID' => $request->AlbumID,
            ]);
        } else {
            $foto->update([
                'JudulFoto' => $request->JudulFoto,
                'DeskripsiFoto' => $request->DeskripsiFoto,
                'AlbumID' => $request->AlbumID,
            ]);
        }

        return redirect()->route('foto.index')->with('success', 'Data foto berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $foto = Foto::where('FotoID', $id)->where('UserID', Auth::user()->UserID)->firstOrFail();
        
        // Hapus file fisik gambar di folder public/fotos
        if(File::exists(public_path('fotos/' . $foto->LokasiFile))) {
            File::delete(public_path('fotos/' . $foto->LokasiFile));
        }
        
        $foto->delete();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus!');
    }
}