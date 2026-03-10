<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Rute yang bisa diakses SEMUA ORANG (Admin & User)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/like/{id}', [HomeController::class, 'like'])->name('home.like');
    Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('home.detail');
    Route::post('/komentar/{id}', [HomeController::class, 'komentar'])->name('home.komentar');

    // Rute KHUSUS ADMIN (Dikawal oleh Middleware IsAdmin)
    Route::middleware([\App\Http\Middleware\IsAdmin::class])->group(function () {
        
        // Rute Kelola Kategori (Album)
        Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
        Route::get('/album/tambah', [AlbumController::class, 'create'])->name('album.create');
        Route::post('/album', [AlbumController::class, 'store'])->name('album.store');
        Route::get('/album/{id}/edit', [AlbumController::class, 'edit'])->name('album.edit');
        Route::put('/album/{id}', [AlbumController::class, 'update'])->name('album.update');
        Route::delete('/album/{id}', [AlbumController::class, 'destroy'])->name('album.destroy');

        // Rute Kelola Produk (Foto)
        Route::get('/foto', [FotoController::class, 'index'])->name('foto.index');
        Route::get('/foto/tambah', [FotoController::class, 'create'])->name('foto.create');
        Route::post('/foto', [FotoController::class, 'store'])->name('foto.store');
        Route::get('/foto/{id}/edit', [FotoController::class, 'edit'])->name('foto.edit');
        Route::put('/foto/{id}', [FotoController::class, 'update'])->name('foto.update');
        Route::delete('/foto/{id}', [FotoController::class, 'destroy'])->name('foto.destroy');
    });
});