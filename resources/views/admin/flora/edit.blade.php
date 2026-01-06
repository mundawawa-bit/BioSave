@extends('components.layoutAdmin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/adminFauna.css') }}">
@endsection

@section('content')

<div class="page-header">
    <h2 class="page-title">Edit Data Flora</h2>
</div>

<div class="form-card">
    <form action="{{ route('admin.flora.update', $flora->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Umum Tumbuhan</label>
            <input type="text" name="name" value="{{ old('name', $flora->name) }}" required>
        </div>

        <div class="form-group">
            <label>Nama Ilmiah (Latin)</label>
            <input type="text" name="scientific_name" value="{{ old('scientific_name', $flora->scientific_name) }}" required>
        </div>

        <div class="form-group">
            <label>Famili</label>
            <input type="text" name="family" value="{{ old('family', $flora->family) }}">
        </div>

        <div class="form-group">
            <label>Habitat/Lokasi Penemuan</label>
            <input type="text" name="habitat" value="{{ old('habitat', $flora->habitat) }}" required>
        </div>

        <div class="form-group">
            <label>Status Konservasi</label>
            <select name="status">
                <option value="">-- Pilih Status --</option>
                <option value="Dilindungi" {{ $flora->status == 'Dilindungi' ? 'selected' : '' }}>Dilindungi</option>
                <option value="Terancam Punah" {{ $flora->status == 'Terancam Punah' ? 'selected' : '' }}>Terancam Punah</option>
                <option value="Langka" {{ $flora->status == 'Langka' ? 'selected' : '' }}>Langka</option>
                <option value="Aman" {{ $flora->status == 'Aman' ? 'selected' : '' }}>Aman</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="5" required>{{ old('description', $flora->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Ganti Foto (Opsional)</label>
            @if($flora->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $flora->image_path) }}" width="120" style="border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                </div>
            @endif
            <label style="font-size: 0.9rem; color: #64748b;">Ganti Foto (Kosongkan jika tidak ingin mengubah)</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.flora.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Perbarui Data</button>
        </div>

    </form>
</div>

@endsection
