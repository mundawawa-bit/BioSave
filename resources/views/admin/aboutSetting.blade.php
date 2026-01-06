@extends('components.layoutAdmin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/adminFauna.css') }}">
@endsection

@section('content')

<div class="page-header">
    <h2 class="page-title">Pengaturan Profil Website (About Us)</h2>
</div>

<div class="form-card">
    <form action="{{ route('admin.about.update') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <h4 style="margin-bottom: 20px; color: #166534; border-bottom: 2px solid #eee; padding-bottom: 10px;">Informasi Utama</h4>

        <div class="form-group">
            <label>Nama Website / Organisasi</label>
            <input type="text" name="company_name" value="{{ old('company_name', $about->company_name) }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi (Siapa Kami)</label>
            <textarea name="description" rows="5" required>{{ old('description', $about->description) }}</textarea>
            <small class="text-muted">Jelaskan secara singkat tentang apa itu BioSave.</small>
        </div>

        <div class="form-group">
            <label>Visi</label>
            <textarea name="vision" rows="3" required>{{ old('vision', $about->vision) }}</textarea>
        </div>

        <div class="form-group">
            <label>Misi</label>
            <textarea name="mission" rows="5" required>{{ old('mission', $about->mission) }}</textarea>
            <small class="text-muted">Gunakan baris baru (Enter) untuk memisahkan poin misi.</small>
        </div>

        <h4 style="margin-top: 40px; margin-bottom: 20px; color: #166534; border-bottom: 2px solid #eee; padding-bottom: 10px;">Informasi Kontak</h4>

        <div class="form-group">
            <label>Email Resmi</label>
            <input type="email" name="email" value="{{ old('email', $about->email) }}">
        </div>

        <div class="form-group">
            <label>Nomor Telepon / WhatsApp</label>
            <input type="text" name="phone" value="{{ old('phone', $about->phone) }}">
        </div>

        <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea name="address" rows="3">{{ old('address', $about->address) }}</textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save" style="width: 100%;">Simpan Perubahan Profil</button>
        </div>

    </form>
</div>

@endsection
