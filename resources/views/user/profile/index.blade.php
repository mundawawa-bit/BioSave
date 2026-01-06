@extends('components.layoutMain')

@section('title', 'Profil Saya')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/profile.css') }}">
@endsection

@section('content')

<h2 class="profile-title">Profil Saya</h2>

@if(session('success'))
    <div style="max-width:500px; margin: 0 auto 20px; background: #dcfce7; color: #166534; padding: 12px; border-radius: 10px; text-align: center;">
        {{ session('success') }}
    </div>
@endif

<div class="profile-card">

    <div class="profile-avatar">
        @if($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Foto Profil">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=166534&color=fff" alt="Default Avatar">
        @endif
    </div>

    <div class="profile-info">
        <label>Nama Lengkap</label>
        <p>{{ $user->name }}</p>
    </div>

    <div class="profile-info">
        <label>Alamat Email</label>
        <p>{{ $user->email }}</p>
    </div>

    <div class="profile-info">
        <label>No. Telepon</label>
        <p>{{ $user->phone ?? '-' }}</p>
    </div>

    <div class="profile-info">
        <label>Bergabung Sejak</label>
        <p>{{ $user->created_at->format('d M Y') }}</p>
    </div>

    <a href="{{ route('user.profile.edit') }}" class="btn-edit">Edit Profil</a>

</div>

@endsection
