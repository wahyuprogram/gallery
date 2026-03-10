<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    // Menampilkan daftar album milik user yang sedang login
    public function index()
    {
        $albums = Album::where('UserID', Auth::user()->UserID)->get();
        return view('album.index', compact('albums'));
    }

    // Menampilkan form tambah album
    public function create()
    {
        return view('album.create');
    }

    // Menyimpan data album ke database
    public function store(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required|max:255',
            'Deskripsi' => 'required'
        ]);

        Album::create([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'TanggalDibuat' => date('Y-m-d'), // Tanggal hari ini otomatis
            'UserID' => Auth::user()->UserID, // ID user yang sedang login
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil ditambahkan!');
    }

    // Menampilkan form edit album
    public function edit($id)
    {
        $album = Album::where('AlbumID', $id)->where('UserID', Auth::user()->UserID)->firstOrFail();
        return view('album.edit', compact('album'));
    }

    // Mengupdate data album di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaAlbum' => 'required|max:255',
            'Deskripsi' => 'required'
        ]);

        $album = Album::where('AlbumID', $id)->where('UserID', Auth::user()->UserID)->firstOrFail();
        
        $album->update([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
        ]);

        return redirect()->route('album.index')->with('success', 'Album berhasil diperbarui!');
    }

    // Menghapus album dari database
    public function destroy($id)
    {
        $album = Album::where('AlbumID', $id)->where('UserID', Auth::user()->UserID)->firstOrFail();
        $album->delete();

        return redirect()->route('album.index')->with('success', 'Album berhasil dihapus!');
    }
}