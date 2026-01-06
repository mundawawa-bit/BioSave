@extends('components.layoutMain')

@section('title', $fauna->name)

@section('styles')
<link rel="stylesheet" href="{{ asset('asset/detail.css') }}">
@endsection

@section('content')

<div class="detail-container">

     {{-- BUTTON KEMBALI --}}
    <div style="margin-bottom: 20px;">
        <a href="{{ route('fauna.index') }}" class="btn-back">
            Kembali
        </a>
    </div>

    <div class="detail-image">
        <img src="{{ asset('storage/' . $fauna->image_path) }}" alt="{{ $fauna->name }}">
    </div>

    <div class="detail-content">
        <h1>{{ $fauna->name }}</h1>
        <p class="latin">{{ $fauna->scientific_name }}</p>

        <div class="info">
            <p><strong>Famili:</strong> {{ $fauna->family ?? '-' }}</p>
            <p><strong>Habitat:</strong> {{ $fauna->habitat ?? '-' }}</p>
            <p><strong>Status:</strong> {{ $fauna->status ?? '-' }}</p>
        </div>

        <div class="description">
            <h3>Deskripsi</h3>
            <p>{{ $fauna->description }}</p>
        </div>

    </div>

</div>

@endsection
