@extends('components.layoutMain')

@section('title', 'Ajukan Baru')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/pengajuan.css') }}">
@endsection

@section('content')

<h2 class="page-title">Ajukan Flora / Fauna Baru</h2>

<div class="form-card">
    <form action="{{ route('user.submission.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 1. Jenis (Flora/Fauna) --}}
        <div class="form-group">
            <label>Jenis Tumbuhan / Satwa</label>
            <select name="type" required>
                <option value="" disabled selected>-- Pilih Jenis --</option>
                <option value="flora">Flora (Tumbuhan)</option>
                <option value="fauna">Fauna (Hewan)</option>
            </select>
        </div>

        {{-- 2. Nama Umum (name) --}}
        <div class="form-group">
            <label>Nama Umum</label>
            <input type="text" name="name" placeholder="Contoh: Harimau Sumatera / Bunga Bangkai" required>
        </div>

        {{-- 3. Nama Ilmiah (scientific_name) --}}
        <div class="form-group">
            <label>Nama Ilmiah (Latin)</label>
            <input type="text" name="scientific_name" placeholder="Contoh: Panthera tigris sumatrae" required>
        </div>

        {{-- 4. Famili (family) - BARU --}}
        <div class="form-group">
            <label>Famili / Suku</label>
            <input type="text" name="family" placeholder="Contoh: Felidae / Araceae">
        </div>

        {{-- 5. Habitat (habitat) --}}
        <div class="form-group">
            <label>Habitat / Lokasi Penemuan</label>
            <input type="text" name="habitat" placeholder="Contoh: Hutan Hujan Tropis / Taman Nasional Gunung Leuser" required>
        </div>

        {{-- 6. Status Konservasi (status) - BARU --}}
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

        {{-- 7. Deskripsi (description) --}}
        <div class="form-group">
            <label>Deskripsi Lengkap</label>
            <textarea name="description" rows="5" placeholder="Jelaskan ciri-ciri fisik, perilaku, atau kondisi unik..." required></textarea>
        </div>

        {{-- 8. Foto (image) --}}
        <div class="form-group">
            <label>Foto Dokumentasi</label>
            {{-- Note: Di controller pastikan simpan file ini ke kolom 'image_path' --}}
            <input type="file" name="image" accept="image/*" required>
            <small style="color: #64748b; display: block; margin-top: 5px;">Format: JPG, PNG. Maksimal 2MB.</small>
        </div>

        <button type="submit" class="btn-submit">Kirim Pengajuan</button>

        <div style="text-align: center; margin-top: 15px;">
            <a href="{{ route('user.submission.index') }}" style="color: #64748b; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>

@endsection
