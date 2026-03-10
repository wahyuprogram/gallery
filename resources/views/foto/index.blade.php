@extends('layouts.app')

@section('title', 'Data Foto - Gallery')

@section('content')
<style>
    .btn-tambah { background-color: #7E57C2; color: white; padding: 10px 15px; text-decoration: none; border-radius: 6px; font-size: 14px; font-weight: bold; transition: 0.3s; }
    .btn-tambah:hover { background-color: #512DA8; box-shadow: 0 4px 8px rgba(81, 45, 168, 0.2); }
    .table-container { margin-top: 20px; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    th, td { padding: 12px 15px; border-bottom: 1px solid #D1C4E9; vertical-align: middle; }
    th { background-color: #EDE7F6; color: #512DA8; font-weight: bold; }
    tr:hover { background-color: #F8F4FF; }
    .btn-edit { background-color: #9575CD; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; transition: 0.3s; }
    .btn-edit:hover { background-color: #7E57C2; }
    .btn-hapus { background-color: #E53935; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-size: 12px; cursor: pointer; transition: 0.3s; }
    .btn-hapus:hover { background-color: #C62828; }
    .alert-success { background-color: #D1C4E9; color: #311B92; border: 1px solid #B39DDB; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-weight: 500; }
    .img-thumbnail { width: 100px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #D1C4E9; }
</style>

<div class="card" style="border-top: 4px solid #7E57C2;">
    <div class="card-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h2 style="color: #512DA8; margin: 0;">Data Foto</h2>
        <a href="{{ route('foto.create') }}" class="btn-tambah">+ Tambah Foto</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Foto</th>
                    <th>Deskripsi</th>
                    <th>Album</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fotos as $item)
                <tr>
                    <td>
                        <img src="{{ asset('fotos/'.$item->LokasiFile) }}" alt="Foto" class="img-thumbnail">
                    </td>
                    <td style="font-weight: bold; color: #311B92;">{{ $item->JudulFoto }}</td>
                    <td>{{ Str::limit($item->DeskripsiFoto, 30) }}</td>
                    <td>{{ $item->NamaAlbum }}</td>
                    <td>{{ $item->TanggalUnggah }}</td>
                    <td style="display: flex; gap: 5px; margin-top: 15px;">
                        <a href="{{ route('foto.edit', $item->FotoID) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('foto.destroy', $item->FotoID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px; color: #7E57C2;">Belum ada data foto. Silakan tambah foto terlebih dahulu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection