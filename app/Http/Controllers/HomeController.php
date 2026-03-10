<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\LikeFoto;
use App\Models\KomentarFoto;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $fotos = Foto::join('gallery_user', 'gallery_foto.UserID', '=', 'gallery_user.UserID')
                     ->select('gallery_foto.*', 'gallery_user.Username')
                     ->orderBy('gallery_foto.FotoID', 'desc')
                     ->get();

        foreach($fotos as $foto) {
            $foto->jml_like = LikeFoto::where('FotoID', $foto->FotoID)->count();
            $foto->jml_komentar = KomentarFoto::where('FotoID', $foto->FotoID)->count();
            $foto->is_liked = LikeFoto::where('FotoID', $foto->FotoID)->where('UserID', Auth::user()->UserID)->exists();
        }

        return view('home', compact('fotos'));
    }

    public function like($id)
    {
        $cekLike = LikeFoto::where('FotoID', $id)->where('UserID', Auth::user()->UserID)->first();

        if ($cekLike) {
            $cekLike->delete();
        } else {
            LikeFoto::create([
                'FotoID' => $id,
                'UserID' => Auth::user()->UserID,
                'TanggalLike' => date('Y-m-d')
            ]);
        }

        return back();
    }

    public function detail($id)
    {
        $foto = Foto::join('gallery_user', 'gallery_foto.UserID', '=', 'gallery_user.UserID')
                    ->select('gallery_foto.*', 'gallery_user.Username')
                    ->where('gallery_foto.FotoID', $id)
                    ->firstOrFail();

        $foto->jml_like = LikeFoto::where('FotoID', $id)->count();
        $foto->is_liked = LikeFoto::where('FotoID', $id)->where('UserID', Auth::user()->UserID)->exists();

        // PENTING: Menambahkan 'gallery_user.Role' pada select query di bawah ini
        $komentars = KomentarFoto::join('gallery_user', 'gallery_komentarfoto.UserID', '=', 'gallery_user.UserID')
                                 ->select('gallery_komentarfoto.*', 'gallery_user.Username', 'gallery_user.Role')
                                 ->where('gallery_komentarfoto.FotoID', $id)
                                 ->orderBy('gallery_komentarfoto.KomentarID', 'asc')
                                 ->get();

        return view('detail', compact('foto', 'komentars'));
    }

    public function komentar(Request $request, $id)
    {
        $request->validate([
            'IsiKomentar' => 'required'
        ]);

        KomentarFoto::create([
            'FotoID' => $id,
            'UserID' => Auth::user()->UserID,
            'IsiKomentar' => $request->IsiKomentar,
            'TanggalKomentar' => date('Y-m-d')
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}