@extends('layouts.app')

@section('title', 'Edit Foto - Gallery')

@section('content')
<style>
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px; color: #311B92; }
    .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #D1C4E9; border-radius: 6px; outline: none; transition: 0.3s; background-color: #fff; }
    .form-group textarea { min-height: 100px; resize: vertical; }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color: #7E57C2; box-shadow: 0 0 5px rgba(126, 87, 194, 0.3); }
    .btn-simpan { background-color: #7E57C2; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s; }
    .btn-simpan:hover { background-color: #512DA8; box-shadow: 0 4px 8px rgba(81, 45, 168, 0.2); }
    .btn-batal { background-color: #E0E0E0; color: #333; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; margin-left: 10px; transition: 0.3s; }
    .btn-batal:hover { background-color: #BDBDBD; }
    .error { color: #E53935; font-size: 12px; margin-top: 5px; }
    .img-preview { width: 150px; border-radius: 6px; margin-bottom: 10px; border: 2px solid #D1C4E9; }
    .card-title { color: #512DA8; }
</style>

<div class="card" style="max-width: 600px; margin: 0 auto; border-top: 4px solid #7E57C2;">
    <h2 class="card-title">Edit Data Foto</h2>

    <form action="{{ route('foto.update', $foto->FotoID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="JudulFoto">Nama Foto</label>
            <input type="text" name="JudulFoto" id="JudulFoto" value="{{ old('JudulFoto', $foto->JudulFoto) }}" required>
            @error('JudulFoto') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="DeskripsiFoto">Deskripsi Foto</label>
            <textarea name="DeskripsiFoto" id="DeskripsiFoto" required>{{ old('DeskripsiFoto', $foto->DeskripsiFoto) }}</textarea>
            @error('DeskripsiFoto') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="AlbumID">Album</label>
            <select name="AlbumID" id="AlbumID" required>
                @foreach($albums as $album)
                    <option value="{{ $album->AlbumID }}" {{ $foto->AlbumID == $album->AlbumID ? 'selected' : '' }}>
                        {{ $album->NamaAlbum }}
                    </option>
                @endforeach
            </select>
            @error('AlbumID') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Foto Saat Ini</label><br>
            <img src="{{ asset('fotos/'.$foto->LokasiFile) }}" alt="Foto Lama" class="img-preview">
        </div>

        <div class="form-group">
            <label for="LokasiFile">Ganti Foto (Kosongkan jika tidak ingin mengganti)</label>
            <input type="file" name="LokasiFile" id="LokasiFile" accept="image/*">
            @error('LokasiFile') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-simpan">Update</button>
            <a href="{{ route('foto.index') }}" class="btn-batal">Batal</a>
        </div>
    </form>
</div>
@endsection