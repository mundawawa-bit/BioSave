@extends('components.layoutAdmin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/adminFauna.css') }}">
@endsection

@section('content')

<div class="page-header">
    <h2 class="page-title">Kelola Data Fauna</h2>
    <a href="{{ route('admin.fauna.create') }}" class="btn-add">
        <i class="fa-solid fa-plus"></i> Tambah Fauna
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
            @forelse($fauna as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                {{-- Gambar --}}
                <td>
                    @if($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}"
                             width="50" style="border-radius:4px;">
                    @else
                        <span style="color:#94a3b8;">No Image</span>
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
                        <a href="{{ route('admin.fauna.edit', $item->id) }}" class="btn-edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('admin.fauna.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                <td colspan="10" style="text-align:center; padding:20px;">
                    Belum ada data fauna.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
