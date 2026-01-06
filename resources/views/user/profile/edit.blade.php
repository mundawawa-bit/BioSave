@extends('components.layoutMain')

@section('title', 'Edit Profil')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/profile.css') }}">
@endsection

@section('content')

<h2 class="profile-title">Edit Profil</h2>

<div class="form-card">

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
            @error('phone') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Ganti Foto Profil (Opsional)</label>
            <input type="file" name="avatar" accept="image/*">
            <small style="color: #64748b; font-size: 12px;">Format: JPG, PNG. Maks 2MB.</small>
            @error('avatar') <span class="error-msg">{{ $message }}</span> @enderror
        </div>

        <div class="btn-group">
            <button type="submit" class="btn-save">Simpan Perubahan</button>
            <a href="{{ route('user.profile') }}" class="btn-cancel">Batal</a>
        </div>
    </form>

</div>

@endsection
