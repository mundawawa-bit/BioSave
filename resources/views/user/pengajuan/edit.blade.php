@extends('components.layoutMain')

@section('title', 'Edit Pengajuan')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/pengajuan.css') }}">
@endsection

@section('content')

<h2 class="page-title">Edit Pengajuan</h2>

<div class="form-card">
    <form action="{{ route('user.submission.update', ['type' => $type, 'id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Jenis (Tidak dapat diubah)</label>
            <input type="text" value="{{ $type }}" disabled style="background: #f1f5f9; color: #64748b; font-weight: bold;">
        </div>

        {{-- name --}}
        <div class="form-group">
            <label>Nama Umum</label>
            <input type="text" name="name" value="{{ old('name', $data->name) }}" required>
        </div>

        {{-- scientific_name --}}
        <div class="form-group">
            <label>Nama Ilmiah (Latin)</label>
            <input type="text" name="scientific_name" value="{{ old('scientific_name', $data->scientific_name) }}">
        </div>

        {{-- family --}}
        <div class="form-group">
            <label>Famili / Suku</label>
            <input type="text" name="family" value="{{ old('family', $data->family) }}">
        </div>

        {{-- habitat --}}
        <div class="form-group">
            <label>Habitat / Lokasi Penemuan</label>
            <input type="text" name="habitat" value="{{ old('habitat', $data->habitat) }}" required>
        </div>

        {{-- status --}}
        <div class="form-group">
            <label>Status Konservasi</label>
            <select name="status" required>
                <option value="">-- Pilih Status --</option>

                <option value="Dilindungi"
                    {{ old('status', $data->status) === 'Dilindungi' ? 'selected' : '' }}>
                    Dilindungi
                </option>

                <option value="Terancam Punah"
                    {{ old('status', $data->status) === 'Terancam Punah' ? 'selected' : '' }}>
                    Terancam Punah
                </option>

                <option value="Langka"
                    {{ old('status', $data->status) === 'Langka' ? 'selected' : '' }}>
                    Langka
                </option>

                <option value="Aman"
                    {{ old('status', $data->status) === 'Aman' ? 'selected' : '' }}>
                    Aman
                </option>
            </select>
        </div>


        {{-- description --}}
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="5" required>{{ old('description', $data->description) }}</textarea>
        </div>

        {{-- image_path --}}
        <div class="form-group">
            <label>Ganti Foto (Opsional)</label>
            @if($data->image_path)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $data->image_path) }}" alt="Preview" style="height: 100px; border-radius: 8px; object-fit: cover;">
                </div>
            @endif
            <input type="file" name="image" accept="image/*">
            <small style="color: #64748b; display: block; margin-top: 5px;">Biarkan kosong jika tidak ingin mengubah foto.</small>
        </div>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>

        <div style="text-align: center; margin-top: 15px;">
            <a href="{{ route('user.submission.index') }}" style="color: #64748b; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>

@endsection
