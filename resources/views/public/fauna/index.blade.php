@extends('components.layoutMain')

@section('title', 'Daftar Fauna - BioSave')

@section('styles')
    <link rel="stylesheet" href="{{ asset('asset/fauna.css') }}">
@endsection

@section('content')

<div class="fauna-title">Daftar Fauna Indonesia</div>

<div class="card-wrapper">

    @forelse($fauna as $item)
        <a href="{{ route('fauna.show', $item->id) }}" class="card">

            <div class="card-image">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}">

                @if($item->status)
                    <span class="badge badge-status">
                        {{ $item->status }}
                    </span>
                @endif

                <span class="badge badge-type">Fauna</span>
            </div>

            <div class="card-body">
                <h3>{{ $item->name }}</h3>

                {{-- Nama ilmiah --}}
                <p class="latin">
                    {{ $item->scientific_name }}
                </p>

                {{-- CREATED BY (HANYA JIKA DIAJUKAN USER) --}}
                @if($item->created_by)
                    <p class="created-by">
                        <strong>Created by:</strong> {{ $item->creator->name }}
                    </p>
                @endif

                <p class="description">
                    {{ Str::limit($item->description, 100) }}
                </p>
            </div>

        </a>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png"
                 width="80"
                 style="opacity:0.5; margin-bottom:15px;">
            <p style="color: #64748b; font-size: 18px;">
                Belum ada data Fauna yang tersedia saat ini.
            </p>
        </div>
    @endforelse

</div>

@endsection
