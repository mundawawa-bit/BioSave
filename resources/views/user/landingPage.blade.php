@extends('components.layoutMain')

@section('title', 'Beranda')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/userHome.css') }}">
@endsection

@section('content')

    <div class="hero">
        <h1>Halo, {{ Auth::user()->name ?? 'Sahabat Alam' }} 👋</h1>
        <p>Terima kasih telah berkontribusi menjaga kelestarian flora dan fauna Indonesia.</p>
    </div>

    <div class="section">
        <h2>🌿 Flora Terbaru</h2>

        <div class="card-wrapper">
            @forelse($flora as $item)
                <div class="card">
                    <div class="card-image">
                        <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/350x220?text=No+Image' }}" alt="{{ $item->name }}">

                        <span class="badge badge-status">Terbaru</span>
                        <span class="badge badge-type">Flora</span>
                    </div>
                    <div class="card-body">
                        <h3>{{ $item->name }}</h3>
                        <p class="latin">{{ $item->latin_name ?? 'Nama Latin' }}</p>
                        <p class="desc">{{ $item->description }}</p>
                    </div>
                </div>
            @empty
                <p style="text-align:center; width:100%; color:#64748b;">Belum ada data Flora.</p>
            @endforelse
        </div>

        <div class="center-btn">
            <a href="{{ route('user.submission.index') }}" class="btn-main">Lihat Semua Flora</a>
        </div>
    </div>

    <div class="section">
        <h2>🦧 Fauna Terbaru</h2>

        <div class="card-wrapper">
            @forelse($fauna as $item)
                <div class="card">
                    <div class="card-image">
                        <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/350x220?text=No+Image' }}" alt="{{ $item->name }}">

                        <span class="badge badge-status">Terbaru</span>
                        <span class="badge badge-type" style="background:#b45309;">Fauna</span>
                    </div>
                    <div class="card-body">
                        <h3>{{ $item->name }}</h3>
                        <p class="latin">{{ $item->latin_name ?? 'Nama Latin' }}</p>
                        <p class="desc">{{ $item->description }}</p>
                    </div>
                </div>
            @empty
                <p style="text-align:center; width:100%; color:#64748b;">Belum ada data Fauna.</p>
            @endforelse
        </div>

        <div class="center-btn">
            <a href="{{ route('user.submission.index') }}" class="btn-main">Lihat Semua Fauna</a>
        </div>
    </div>


@endsection
