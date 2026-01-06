@extends('components.layoutMain')

@section('title', 'Selamat Datang')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/home.css') }}">
@endsection

@section('content')


    <div class="hero">
        <h1>Menjaga Keanekaragaman Hayati Indonesia</h1>
        <p>Platform edukatif untuk mengenal, mendata, dan melestarikan kekayaan flora dan fauna nusantara.</p>

        @guest
            <div style="margin-top: 30px;">
                <a href="{{ route('register') }}" style="background: white; color: #2e7d32; padding: 12px 30px; border-radius: 30px; text-decoration: none; font-weight: bold; margin-right: 10px;">Bergabung Sekarang</a>
            </div>
        @endguest
    </div>

    <div class="section">
        <h2>🌿 Flora Indonesia</h2>

        <div class="card-wrapper">
            @forelse($flora as $item)
                <div class="card">
                    <div class="card-image">
                        <img
                            src="{{ $item->image_path
                                ? asset('storage/' . $item->image_path)
                                : 'https://via.placeholder.com/350x220?text=No+Image' }}"
                            alt="{{ $item->name }}">

                        {{-- STATUS KONSERVASI --}}
                        <span class="badge badge-status">
                            {{ $item->status ?? 'Tidak Diketahui' }}
                        </span>

                        <span class="badge badge-type">Flora</span>
                    </div>

                    <div class="card-body">
                        <h3>{{ $item->name }}</h3>

                        <p class="latin">
                            {{ $item->scientific_name ?? 'Nama Latin tidak tersedia' }}
                        </p>

                        {{-- CREATED BY --}}
                        <p style="font-size:13px;color:#6b7280;margin-bottom:6px;">
                            Created by:
                            <strong>
                                {{ optional($item->creator)->name ?? 'Anonim' }}
                            </strong>
                        </p>

                        <p class="desc">{{ Str::limit($item->description, 120) }}</p>
                    </div>
                </div>
            @empty

                <div style="text-align:center; width:100%; grid-column: 1/-1;">
                    <p style="color: #6b7280;">Belum ada data flora yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

        <div class="center-btn">
            {{-- Pastikan route 'flora.index' (halaman publik flora) sudah ada --}}
            <a href="{{ route('flora.index') }}" class="btn-main">Jelajahi Semua Flora</a>
        </div>
    </div>

    <div class="section" style="background: #f9fafb;">
        <h2>🦧 Fauna Indonesia</h2>

        <div class="card-wrapper">
            @forelse($fauna as $item)
                <div class="card">
                    <div class="card-image">
                        <img
                            src="{{ $item->image_path
                                ? asset('storage/' . $item->image_path)
                                : 'https://via.placeholder.com/350x220?text=No+Image' }}"
                            alt="{{ $item->name }}">

                        {{-- STATUS KONSERVASI --}}
                        <span class="badge badge-status">
                            {{ $item->status ?? 'Tidak Diketahui' }}
                        </span>

                        <span class="badge badge-type" style="background:#b45309;">
                            Fauna
                        </span>
                    </div>

                    <div class="card-body">
                        <h3>{{ $item->name }}</h3>

                        <p class="latin">
                            {{ $item->scientific_name ?? 'Nama Latin tidak tersedia' }}
                        </p>

                        {{-- CREATED BY --}}
                        <p style="font-size:13px;color:#6b7280;margin-bottom:6px;">
                            Created by:
                            <strong>
                                {{ optional($item->creator)->name ?? 'Anonim' }}
                            </strong>
                        </p>

                        <p class="desc">{{ Str::limit($item->description, 120) }}</p>
                    </div>
                </div>
            @empty

                <div style="text-align:center; width:100%; grid-column: 1/-1;">
                    <p style="color: #6b7280;">Belum ada data fauna yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

        <div class="center-btn">
            {{-- Pastikan route 'fauna.index' (halaman publik fauna) sudah ada --}}
            <a href="{{ route('fauna.index') }}" class="btn-main">Jelajahi Semua Fauna</a>
        </div>
    </div>

@endsection
