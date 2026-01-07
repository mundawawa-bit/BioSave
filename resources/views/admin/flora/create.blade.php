@extends('components.layoutAdmin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/adminFauna.css') }}">
@endsection

@section('content')

<div class="page-header">
    <h2 class="page-title">Tambah Flora Baru</h2>
</div>

<div class="form-card">
    <form action="{{ route('admin.flora.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Error Message --}}
        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                <ul style="margin:0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label>Nama Umum Tumbuhan</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Bunga Raflesia" required>
        </div>

        <div class="form-group">
            <label>Nama Ilmiah (latin)</label>
            <input type="text" name="scientific_name" value="{{ old('scientific_name') }}" placeholder="Contoh: Rafflesia arnoldii" required>
        </div>

        <div class="form-group">
            <label>Famili</label>
            <input type="text" name="family" value="{{ old('family') }}" placeholder="Contoh: Rafflesiaceae">
        </div>

        <div class="form-group">
            <label>Habitat / Lokasi Penemuan</label>
            <input type="text" name="habitat" value="{{ old('habitat') }}" placeholder="Contoh: Hutan hujan tropis Sumatera" required>
        </div>

        <div class="form-group">
            <label>Status Konservasi</label>
            <select name="status">
                <option value="">-- Pilih Status --</option>
                <option value="Terancam (EN)">Terancam</option>
                <option value="Langka">Langka</option>
                <option value="Rentan">Rentan</option>
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
            <a href="{{ route('admin.flora.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Data</button>
        </div>

    </form>
</div>

@endsection
