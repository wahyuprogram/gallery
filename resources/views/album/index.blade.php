@extends('layouts.app')

@section('title', 'Album - Gallery')

@section('content')
<style>
    .btn-tambah { background-color: #7E57C2; color: white; padding: 10px 15px; text-decoration: none; border-radius: 6px; font-size: 14px; font-weight: bold; transition: 0.3s; }
    .btn-tambah:hover { background-color: #512DA8; box-shadow: 0 4px 8px rgba(81, 45, 168, 0.2); }
    .table-container { margin-top: 20px; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    th, td { padding: 12px 15px; border-bottom: 1px solid #D1C4E9; }
    th { background-color: #EDE7F6; color: #512DA8; font-weight: bold; }
    tr:hover { background-color: #F8F4FF; }
    .btn-edit { background-color: #9575CD; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; transition: 0.3s; }
    .btn-edit:hover { background-color: #7E57C2; }
    .btn-hapus { background-color: #E53935; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-size: 12px; cursor: pointer; transition: 0.3s; }
    .btn-hapus:hover { background-color: #C62828; }
    .alert-success { background-color: #D1C4E9; color: #311B92; border: 1px solid #B39DDB; padding: 10px; border-radius: 6px; margin-bottom: 15px; font-weight: 500; }
</style>

<div class="card" style="border-top: 4px solid #7E57C2;">
    <div class="card-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h2 style="color: #512DA8; margin: 0;">Data Album</h2>
        <a href="{{ route('album.create') }}" class="btn-tambah">+ Tambah Album</a>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Album</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="font-weight: bold; color: #311B92;">{{ $item->NamaAlbum }}</td>
                    <td>{{ $item->Deskripsi }}</td>
                    <td>{{ $item->TanggalDibuat }}</td>
                    <td style="display: flex; gap: 5px;">
                        <a href="{{ route('album.edit', $item->AlbumID) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('album.destroy', $item->AlbumID) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus album ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px; color: #7E57C2;">Belum ada data album.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection