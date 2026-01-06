@extends('components.layoutMain')

@section('title', $flora->name)

@section('styles')
<link rel="stylesheet" href="{{ asset('asset/detail.css') }}">
@endsection

@section('content')

<div class="detail-container">

    {{-- BUTTON KEMBALI --}}
    <div style="margin-bottom: 20px;">
        <a href="{{ route('flora.index') }}" class="btn-back">
            Kembali
        </a>
    </div>

    <div class="detail-image">
        <img src="{{ asset('storage/' . $flora->image_path) }}" alt="{{ $flora->name }}">
    </div>

    <div class="detail-content">
        <h1>{{ $flora->name }}</h1>
        <p class="latin">{{ $flora->scientific_name }}</p>

        <div class="info">
            <p><strong>Famili:</strong> {{ $flora->family ?? '-' }}</p>
            <p><strong>Habitat:</strong> {{ $flora->habitat ?? '-' }}</p>
            <p><strong>Status:</strong> {{ $flora->status ?? '-' }}</p>
        </div>

        <div class="description">
            <h3>Deskripsi</h3>
            <p>{{ $flora->description }}</p>
        </div>

    </div>

</div>

@endsection
