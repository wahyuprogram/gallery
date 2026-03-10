<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN perannya (Role) adalah 'admin'
        if (Auth::check() && Auth::user()->Role === 'admin') {
            // Jika dia admin, persilakan masuk ke rute yang dituju
            return $next($request);
        }

        // Jika dia BUKAN admin, tendang kembali ke halaman Beranda dengan pesan error
        return redirect()->route('home')->with('error', 'Akses Ditolak! Anda tidak memiliki izin Admin.');
    }
}