@extends('components.layoutAdmin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/adminFauna.css') }}">
@endsection

@section('content')

<div class="page-header">
    <h2 class="page-title">Tambah Fauna Baru</h2>
</div>

<div class="form-card">
    <form action="{{ route('admin.fauna.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Menampilkan Error Validasi --}}
        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label>Nama Umum</label>
            <input type="text" name="name" placeholder="Contoh: Harimau Sumatera" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label>Nama Ilmiah (Latin)</label>
            <input type="text" name="scientific_name" placeholder="Contoh: Panthera tigris sumatrae" value="{{ old('scientific_name') }}" required>
        </div>

        <div class="form-group">
            <label>Famili / Suku</label>
            <input type="text" name="family" placeholder="Contoh: Felidae" value="{{ old('family') }}">
        </div>

        <div class="form-group">
            <label>Habitat/Lokasi Penemuan</label>
            <input type="text" name="habitat" placeholder="Contoh: Hutan Hujan Tropis" value="{{ old('habitat') }}" required>
        </div>

        <div class="form-group">
            <label>Status Konservasi</label>
            <select name="status">
                <option value="">-- Pilih Status --</option>
                <option value="Dilindungi">Dilindungi</option>
                <option value="Terancam Punah">Terancam Punah</option>
                <option value="Langka">Langka</option>
                <option value="Aman">Aman</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Foto Dokumentasi</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.fauna.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Data</button>
        </div>

    </form>
</div>

@endsection
