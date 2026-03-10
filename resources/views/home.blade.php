@extends('layouts.app')

@section('title', 'Beranda - Gallery')

@section('content')
<style>
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; margin-top: 20px; }
    .gallery-item { background: #FFFFFF; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(81, 45, 168, 0.08); transition: transform 0.3s; border: 1px solid #EDE7F6; }
    .gallery-item:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(81, 45, 168, 0.15); border-color: #D1C4E9; }
    .gallery-img { width: 100%; height: 220px; object-fit: cover; display: block; border-bottom: 3px solid #7E57C2; }
    .gallery-info { padding: 15px; }
    .gallery-title { font-size: 18px; font-weight: bold; color: #512DA8; margin-bottom: 5px; }
    .gallery-uploader { font-size: 12px; color: #7E57C2; margin-bottom: 10px; }
    .gallery-desc { font-size: 14px; color: #311B92; margin-bottom: 15px; line-height: 1.5; }
    .action-bar { display: flex; justify-content: space-between; border-top: 1px solid #EDE7F6; padding-top: 12px; align-items: center; }
    .btn-action { background: none; border: none; color: #7E57C2; cursor: pointer; font-size: 14px; font-weight: bold; text-decoration: none; display: flex; align-items: center; gap: 5px; transition: 0.3s;}
    .btn-action:hover { color: #311B92; }
</style>

<div class="card" style="background-color: transparent; box-shadow: none; padding: 0;">
    <h2 class="card-title" style="background-color: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(81, 45, 168, 0.08); border-top: 4px solid #7E57C2;">
        Gallery Terbaru
    </h2>
    
    <div class="gallery-grid">
        @forelse($fotos as $foto)
            <div class="gallery-item">
                <img src="{{ asset('fotos/' . $foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}" class="gallery-img">
                <div class="gallery-info">
                    <div class="gallery-title">{{ $foto->JudulFoto }}</div>
                    <div class="gallery-uploader">Diunggah oleh: <b>{{ $foto->Username }}</b></div>
                    <div class="gallery-desc">{{ Str::limit($foto->DeskripsiFoto, 60) }}</div>
                    
                    <div class="action-bar">
                        <form action="{{ route('home.like', $foto->FotoID) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn-action" style="color: {{ $foto->is_liked ? '#E53935' : '#7E57C2' }};">
                                {{ $foto->is_liked ? '❤️' : '🤍' }} {{ $foto->jml_like }} Suka
                            </button>
                        </form>
                        
                        <a href="{{ route('home.detail', $foto->FotoID) }}" class="btn-action">💬 {{ $foto->jml_komentar }} Komen</a>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background-color: #fff; border-radius: 12px; color: #7E57C2; font-weight: bold; border-top: 4px solid #D1C4E9;">
                Belum ada foto di dalam katalog.
            </div>
        @endforelse
    </div>
</div>
@endsection