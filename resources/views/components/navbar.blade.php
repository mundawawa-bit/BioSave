<style>
    .biosave-navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: box-shadow 0.3s ease;
    }

    .biosave-navbar.scrolled {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
</style>

<nav class="biosave-navbar d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm">


    <div class="d-flex align-items-center gap-4">

        {{-- 1. LOGO APLIKASI --}}
        <a href="{{ Auth::check() ? route('home') : url('/') }}" class="text-decoration-none">
            <h4 class="m-0 fw-bold" style="color: #166534;">BioSave</h4>
        </a>

        {{-- 2. MENU NAVIGASI KIRI --}}
        <div class="d-flex gap-3 align-items-center">

            @auth
                {{-- === TAMPILAN KHUSUS MEMBER (SUDAH LOGIN) === --}}

                <a href="{{ route('user.home') }}" class="text-decoration-none text-secondary fw-semibold">Home</a>
                <a href="{{ route('user.profile') }}" class="text-decoration-none text-secondary fw-semibold">Profil</a>
                <a href="{{ route('user.submission.index') }}" class="text-decoration-none text-secondary fw-semibold">Pengajuan</a>

            @else
                {{-- === TAMPILAN KHUSUS PUBLIC (BELUM LOGIN) === --}}
                {{-- Flora & Fauna HANYA ADA di sini --}}

                <a href="{{ url('/') }}" class="text-decoration-none text-secondary fw-semibold">Home</a>
                <a href="{{ url('/flora') }}" class="text-decoration-none text-secondary fw-semibold">Flora</a>
                <a href="{{ url('/fauna') }}" class="text-decoration-none text-secondary fw-semibold">Fauna</a>
                <a href="{{ url('/about') }}" class="text-decoration-none text-secondary fw-semibold">About Us</a>

            @endauth

        </div>
    </div>

    {{-- 3. MENU KANAN (TOMBOL AKUN) --}}
    <div class="d-flex align-items-center">

        @auth
            {{-- JIKA SUDAH LOGIN --}}

            {{-- Tombol Logout --}}
            <form action="{{ route('logout') }}" method="POST" style="display:inline;" class="me-3">
                @csrf
                <button type="submit" class="logout-btn icon-only"
                        style="background:none; border:none; cursor:pointer; color:#dc3545; font-size:1.4rem;"
                        title="Keluar Aplikasi">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>

            {{-- Foto Profil & Nama --}}
            <div class="d-flex align-items-center border-start ps-3">
                <div class="text-end me-3">
                    <small class="d-block text-muted" style="font-size: 0.8rem;">Halo,</small>
                    <span class="fw-bold" style="color: #166534;">{{ Auth::user()->name }}</span>
                </div>

                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                         class="rounded-circle shadow-sm"
                         style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #fff;">
                @else
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                         style="background-color: #166534; width: 40px; height: 40px; font-weight: bold; font-size: 1.2rem;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
            </div>

        @else
            {{-- JIKA BELUM LOGIN (Tamu) --}}
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-success fw-bold px-3" style="border-radius: 20px;">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-success fw-bold px-3" style="border-radius: 20px;">
                    Register
                </a>
            </div>
        @endauth

    </div>
</nav>
