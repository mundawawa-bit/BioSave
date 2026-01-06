@extends('components.layoutMain')

@section('title', 'About Us | ' . ($about->company_name ?? 'BioSave'))

@section('styles')
    {{-- Panggil CSS khusus About --}}
    <link rel="stylesheet" href="{{ asset('asset/about.css') }}">

    {{-- Override sedikit agar Navbar bawaan Layout tidak tertutup background --}}
    <style>
        /* Agar background gradient tetap jalan tapi tidak menimpa navbar */
        body {
            background: linear-gradient(135deg, #e8f5e9, #f1f8f4) !important;
        }
        /* Memberi jarak karena ada Navbar di layout utama */
        .about-wrapper {
            padding-top: 40px;
            padding-bottom: 60px;
        }
    </style>
@endsection

@section('content')

<div class="about-wrapper">
    <div class="container">

        <div class="header">
            <h1>Tentang {{ $about->company_name ?? 'BioSave' }}</h1>
            <p>Melindungi flora & fauna melalui teknologi dan partisipasi publik</p>
        </div>

        @if($about)
            <div class="section">
                <h2>Siapa Kami</h2>
                <p>{{ $about->description }}</p>
            </div>

            <div class="section grid">
                <div class="card">
                    <h2><i class="fa-solid fa-eye" style="color: var(--green);"></i> Visi</h2>
                    <p>{{ $about->vision }}</p>
                </div>
                <div class="card">
                    <h2><i class="fa-solid fa-bullseye" style="color: var(--green);"></i> Misi</h2>
                    <p>{!! nl2br(e($about->mission)) !!}</p>
                </div>
            </div>

            @if($about->email || $about->address || $about->phone)
            <div class="section">
                <h2>Hubungi Kami</h2>
                <div class="contact-info">
                    @if($about->address)
                        <p><i class="fa-solid fa-location-dot" style="width: 20px;"></i> {{ $about->address }}</p>
                    @endif

                    @if($about->email)
                        <p><i class="fa-solid fa-envelope" style="width: 20px;"></i> {{ $about->email }}</p>
                    @endif

                    @if($about->phone)
                        <p><i class="fa-brands fa-whatsapp" style="width: 20px;"></i> {{ $about->phone }}</p>
                    @endif
                </div>
            </div>
            @endif

        @else
            <div class="text-center py-5 text-muted">
                <h3>Data profil belum diatur oleh Admin.</h3>
            </div>
        @endif

    </div>
</div>

@endsection
