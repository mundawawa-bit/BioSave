@extends('components.layoutAdmin')

@section('title', 'Data Anggota')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/dataAnggota.css') }}">
    <style>
        /* Style tambahan untuk Pagination (Opsional) */
        .pagination { display: flex; list-style: none; gap: 5px; margin-top: 20px; justify-content: center; }
        .pagination li a, .pagination li span { padding: 8px 12px; border: 1px solid #ddd; color: #333; text-decoration: none; border-radius: 4px; }
        .pagination li.active span { background-color: #166534; color: white; border-color: #166534; }

        /* Alert Sukses */
        .alert-success { background: #dcfce7; color: #166534; padding: 10px; margin-bottom: 20px; border-radius: 8px; }
    </style>
@endsection

@section('content')

<div class="container">

    <div class="header">
        <h1>Data Anggota Biosave</h1>

        <div class="search-box">
            <form action="{{ route('admin.dataAnggota.index') }}" method="GET">
                <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                <button type="submit" style="display:none;">Cari</button> </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Foto</th>
                <th width="20%">Nama</th> <th width="20%">Email</th>
                <th width="15%">No. Telepon</th> <th width="15%">Bergabung</th>
                <th width="5%">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $index => $user)
            <tr>
                <td>{{ $users->firstItem() + $index }}</td>

                <td>
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar" alt="Foto {{ $user->name }}" style="object-fit:cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=c8e6c9&color=1b5e20" class="avatar" alt="Default">
                    @endif
                </td>

                <td><strong>{{ $user->name }}</strong></td>
                <td>{{ $user->email }}</td>

                <td>{{ $user->phone ?? '-' }}</td>

                <td>{{ $user->created_at->format('d M Y') }}</td>

                <td>
                    <div class="action-group" style="justify-content: center;">
                        <form action="{{ route('admin.dataAnggota.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $user->name }}? Data flora & fauna miliknya juga akan hilang.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; color: #9ca3af; padding: 30px;">
                    Tidak ada data anggota ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $users->withQueryString()->links() }}
        </div>

</div>

@endsection
