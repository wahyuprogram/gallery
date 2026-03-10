@extends('layouts.app')

@section('title', $foto->JudulFoto . ' - Gallery')

@section('content')
<style>
    .detail-container { display: flex; flex-direction: column; gap: 20px; }
    .foto-besar { width: 100%; max-height: 500px; object-fit: contain; background-color: #F8F4FF; border-radius: 12px; border: 2px solid #D1C4E9; }
    .info-box { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(81, 45, 168, 0.08); border-top: 4px solid #7E57C2; }
    .foto-title { font-size: 24px; color: #512DA8; margin-bottom: 5px; }
    .foto-uploader { font-size: 14px; color: #7E57C2; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #EDE7F6; }
    .btn-action { background: none; border: none; cursor: pointer; font-size: 16px; font-weight: bold; padding: 10px 15px; border-radius: 6px; background-color: #EDE7F6; transition: 0.3s; display: inline-flex; align-items: center; }
    .btn-action:hover { background-color: #D1C4E9; }
    .komentar-box { margin-top: 30px; }
    .komentar-list { margin-top: 15px; max-height: 500px; overflow-y: auto; padding-right: 5px; }
    
    /* Desain Default Komentar User */
    .komentar-item { background: #F8F4FF; padding: 15px; border-radius: 8px; margin-bottom: 10px; border-left: 4px solid #D1C4E9; transition: 0.3s; }
    .komentar-user { font-weight: bold; color: #311B92; font-size: 14px; margin-bottom: 5px; display: flex; justify-content: space-between; align-items: center; }
    .komentar-isi { color: #4A3B32; font-size: 14px; line-height: 1.5; }
    .komentar-tanggal { font-size: 11px; color: #7E57C2; margin-top: 5px; }
    
    /* Desain Khusus Komentar Admin */
    .komentar-admin { background: #EDE7F6; border-left: 4px solid #512DA8; }
    .badge-admin { background-color: #512DA8; color: white; padding: 2px 8px; border-radius: 12px; font-size: 10px; margin-left: 8px; vertical-align: middle; font-weight: bold; }
    
    /* Desain Balasan Menjorok ke Kanan */
    .komentar-balasan { margin-left: 40px; position: relative; border-left: 4px solid #9575CD; margin-top: -5px; }
    .komentar-balasan::before { content: "↳"; position: absolute; left: -25px; top: 12px; color: #7E57C2; font-weight: bold; font-size: 18px; }
    
    /* Tombol Balas */
    .btn-balas { background: none; border: none; color: #7E57C2; cursor: pointer; font-size: 12px; font-weight: bold; transition: 0.3s; }
    .btn-balas:hover { color: #512DA8; text-decoration: underline; }

    .form-group textarea { width: 100%; padding: 15px; border: 1px solid #D1C4E9; border-radius: 6px; outline: none; margin-bottom: 10px; font-family: inherit; resize: vertical; min-height: 80px; }
    .form-group textarea:focus { border-color: #7E57C2; box-shadow: 0 0 5px rgba(126, 87, 194, 0.3); }
    .btn-kirim { background-color: #7E57C2; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s; }
    .btn-kirim:hover { background-color: #512DA8; box-shadow: 0 4px 8px rgba(81, 45, 168, 0.2); }
    .btn-kembali { text-decoration: none; color: #7E57C2; font-weight: bold; display: inline-block; margin-bottom: 15px; transition: 0.3s; }
    .btn-kembali:hover { color: #311B92; }
</style>

<div class="detail-container">
    <a href="{{ route('home') }}" class="btn-kembali">⬅ Kembali ke Beranda</a>
    
    <img src="{{ asset('fotos/' . $foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}" class="foto-besar">

    <div class="info-box">
        <h1 class="foto-title">{{ $foto->JudulFoto }}</h1>
        <div class="foto-uploader">Diunggah oleh <b>{{ $foto->Username }}</b> pada {{ $foto->TanggalUnggah }}</div>
        <p style="color: #311B92; line-height: 1.6; margin-bottom: 20px; font-size: 16px;">{{ $foto->DeskripsiFoto }}</p>
        
        <form action="{{ route('home.like', $foto->FotoID) }}" method="POST">
            @csrf
            <button type="submit" class="btn-action" style="color: {{ $foto->is_liked ? '#E53935' : '#512DA8' }};">
                {{ $foto->is_liked ? '❤️' : '🤍' }} {{ $foto->jml_like }} Suka
            </button>
        </form>

        <div class="komentar-box">
            <h3 style="color: #512DA8; margin-bottom: 15px; border-bottom: 1px solid #EDE7F6; padding-bottom: 10px;">
                💬 Komentar ({{ $komentars->count() }})
            </h3>
            
            @if(session('success'))
                <div style="background-color: #D1C4E9; color: #311B92; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-weight: 500; border: 1px solid #B39DDB;">{{ session('success') }}</div>
            @endif

            <form action="{{ route('home.komentar', $foto->FotoID) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea id="InputKomentar" name="IsiKomentar" placeholder="Tanyakan sesuatu atau balas komentar di sini..." required></textarea>
                </div>
                <button type="submit" class="btn-kirim">Kirim Komentar</button>
            </form>

            <div class="komentar-list">
                @php
                    $mainComments = [];
                    $replies = [];

                    // Memisahkan komentar utama dan komentar balasan (yang diawali @)
                    foreach($komentars as $k) {
                        if(Str::startsWith(trim($k->IsiKomentar), '@')) {
                            $replies[] = $k;
                        } else {
                            $mainComments[] = $k;
                        }
                    }
                @endphp

                @if(count($komentars) == 0)
                    <div style="text-align: center; padding: 20px; color: #7E57C2; font-style: italic;">
                        Belum ada yang bertanya. Jadilah yang pertama berkomentar!
                    </div>
                @else
                    @foreach($mainComments as $komen)
                        <div class="komentar-item {{ $komen->Role == 'admin' ? 'komentar-admin' : '' }}">
                            <div class="komentar-user">
                                <div>
                                    {{ $komen->Username }}
                                    @if($komen->Role == 'admin')
                                        <span class="badge-admin">👑 Admin - Gallery</span>
                                    @endif
                                </div>
                                
                                @if(auth()->user()->Role == 'admin' && $komen->Role != 'admin')
                                    <button type="button" class="btn-balas" onclick="balasUser('{{ $komen->Username }}')">Balas ↩</button>
                                @endif
                            </div>
                            <div class="komentar-isi">{{ $komen->IsiKomentar }}</div>
                            <div class="komentar-tanggal">{{ $komen->TanggalKomentar }}</div>
                        </div>

                        @php $sisaReplies = []; @endphp
                        @foreach($replies as $reply)
                            @if(Str::startsWith(trim($reply->IsiKomentar), '@' . $komen->Username))
                                @php
                                    // Bersihkan teks (Hapus tulisan "@namauser - ") agar rapi
                                    $teksBersih = Str::replaceFirst('@' . $komen->Username, '', $reply->IsiKomentar);
                                    $teksBersih = ltrim($teksBersih, ' -:');
                                @endphp
                                <div class="komentar-item komentar-balasan {{ $reply->Role == 'admin' ? 'komentar-admin' : '' }}">
                                    <div class="komentar-user">
                                        <div>
                                            {{ $reply->Username }}
                                            @if($reply->Role == 'admin')
                                                <span class="badge-admin">👑 Admin</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="komentar-isi">{{ $teksBersih }}</div>
                                    <div class="komentar-tanggal">{{ $reply->TanggalKomentar }}</div>
                                </div>
                            @else
                                @php $sisaReplies[] = $reply; @endphp
                            @endif
                        @endforeach
                        @php $replies = $sisaReplies; @endphp
                    @endforeach

                    @foreach($replies as $reply)
                        <div class="komentar-item komentar-balasan {{ $reply->Role == 'admin' ? 'komentar-admin' : '' }}">
                            <div class="komentar-user">
                                <div>
                                    {{ $reply->Username }}
                                    @if($reply->Role == 'admin')
                                        <span class="badge-admin">👑 Admin</span>
                                    @endif
                                </div>
                            </div>
                            <div class="komentar-isi">{{ $reply->IsiKomentar }}</div>
                            <div class="komentar-tanggal">{{ $reply->TanggalKomentar }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function balasUser(username) {
        const kotakKomentar = document.getElementById('InputKomentar');
        // Isi otomatis dengan format tagging
        kotakKomentar.value = '@' + username + ' - ';
        // Arahkan kursor langsung ke kotak komentar
        kotakKomentar.focus();
    }
</script>
@endsection