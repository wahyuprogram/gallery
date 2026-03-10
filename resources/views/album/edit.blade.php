@extends('layouts.app')

@section('title', 'Edit Album - Gallery')

@section('content')
<style>
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 14px; color: #311B92; }
    .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #D1C4E9; border-radius: 6px; outline: none; transition: 0.3s; }
    .form-group textarea { min-height: 100px; resize: vertical; }
    .form-group input:focus, .form-group textarea:focus { border-color: #7E57C2; box-shadow: 0 0 5px rgba(126, 87, 194, 0.3); }
    .btn-simpan { background-color: #7E57C2; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s; }
    .btn-simpan:hover { background-color: #512DA8; }
    .btn-batal { background-color: #E0E0E0; color: #333; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; margin-left: 10px; transition: 0.3s; }
    .btn-batal:hover { background-color: #BDBDBD; }
    .error { color: #d9534f; font-size: 12px; margin-top: 5px; }
    .card-title { color: #512DA8; }
</style>

<div class="card" style="max-width: 600px; margin: 0 auto; border-top: 4px solid #7E57C2;">
    <h2 class="card-title">Edit Album</h2>

    <form action="{{ route('album.update', $album->AlbumID) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="NamaAlbum">Nama Album</label>
            <input type="text" name="NamaAlbum" id="NamaAlbum" value="{{ old('NamaAlbum', $album->NamaAlbum) }}" required>
            @error('NamaAlbum') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="Deskripsi">Deskripsi</label>
            <textarea name="Deskripsi" id="Deskripsi" required>{{ old('Deskripsi', $album->Deskripsi) }}</textarea>
            @error('Deskripsi') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-simpan">Update Album</button>
            <a href="{{ route('album.index') }}" class="btn-batal">Batal</a>
        </div>
    </form>
</div>
@endsection