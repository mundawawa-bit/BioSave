@extends('components.layoutAdmin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/adminFauna.css') }}">
@endsection

@section('content')

<div class="page-header">
    <h2 class="page-title">Edit Data Fauna</h2>
</div>

<div class="form-card">
    <form action="{{ route('admin.fauna.update', $fauna->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Umum</label>
            <input type="text" name="name" value="{{ old('name', $fauna->name) }}" required>
        </div>

        <div class="form-group">
            <label>Nama Ilmiah (Latin)</label>
            <input type="text" name="scientific_name" value="{{ old('scientific_name', $fauna->scientific_name) }}" required>
        </div>

        <div class="form-group">
            <label>Famili</label>
            <input type="text" name="family" value="{{ old('family', $fauna->family) }}">
        </div>

        <div class="form-group">
            <label>Habitat/Lokasi Penemuan</label>
            <input type="text" name="habitat" value="{{ old('habitat', $fauna->habitat) }}" required>
        </div>

        <div class="form-group">
            <label>Status Konservasi</label>
            <select name="status">
                <option value="">-- Pilih Status --</option>
                <option value="Dilindungi" {{ $fauna->status == 'Dilindungi' ? 'selected' : '' }}>Dilindungi</option>
                <option value="Terancam Punah" {{ $fauna->status == 'Terancam Punah' ? 'selected' : '' }}>Terancam Punah</option>
                <option value="Langka" {{ $fauna->status == 'Langka' ? 'selected' : '' }}>Langka</option>
                <option value="Aman" {{ $fauna->status == 'Aman' ? 'selected' : '' }}>Aman</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="5" required>{{ old('description', $fauna->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Ganti Foto (Opsional)</label>
            @if($fauna->image_path)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $fauna->image_path) }}" width="100" style="border-radius: 5px;">
                </div>
            @endif
            <input type="file" name="image" accept="image/*">
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.fauna.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Perbarui Data</button>
        </div>

    </form>
</div>

@endsection
