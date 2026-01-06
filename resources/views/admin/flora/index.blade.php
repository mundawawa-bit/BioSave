@extends('components.layoutAdmin')

@section('styles')
    {{-- Menggunakan CSS yang sama dengan Fauna --}}
    <link rel="stylesheet" href="{{ asset('asset/adminFauna.css') }}">
@endsection

@section('content')

<div class="page-header">
    <h2 class="page-title">Kelola Data Flora</h2>
    <a href="{{ route('admin.flora.create') }}" class="btn-add">
        <i class="fa-solid fa-plus"></i> Tambah Flora
    </a>
</div>

<div class="table-container">
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Umum</th>
                <th>Nama Ilmiah</th>
                <th>Famili</th>
                <th>Habitat</th>
                <th>Status Konservasi</th>
                <th>Deskripsi</th>
                <th>Diajukan Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($flora as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                {{-- Gambar --}}
                <td>
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}"
                             width="50" height="50"
                             style="object-fit: cover; border-radius: 4px;">
                    @else
                        <span style="color:#94a3b8; font-size:0.8rem;">No Image</span>
                    @endif
                </td>

                {{-- Nama --}}
                <td>{{ $item->name }}</td>

                {{-- Nama Ilmiah --}}
                <td><i>{{ $item->scientific_name }}</i></td>

                {{-- Famili --}}
                <td>{{ $item->family ?? '-' }}</td>

                {{-- Habitat --}}
                <td>{{ $item->habitat }}</td>

                {{-- Status --}}
                <td>{{ $item->status ?? '-' }}</td>

                {{-- Deskripsi --}}
                <td title="{{ $item->description }}">
                    {{ Str::limit($item->description, 50, '...') }}
                </td>

                {{-- Diajukan Oleh --}}
                <td>
                    {{ optional($item->creator)->name ?? 'Admin' }}
                </td>

                {{-- Aksi --}}
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.flora.edit', $item->id) }}" class="btn-edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('admin.flora.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data flora ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10"
                    style="text-align:center; padding:20px; color:#64748b;">
                    Belum ada data flora.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
