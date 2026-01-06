@extends('components.layoutAuth')

@section('content')

<style>
    /* ===== Background halaman ===== */
    body {
        background: #edf7f1 !important; /* soft green */
        font-family: 'Poppins', sans-serif !important;
    }

    /* ===== Card auth ===== */
    .min-h-screen .bg-white {
        background: #f7fcfa !important;
        width: 420px !important;
        padding: 40px !important;
        border-radius: 18px !important;
        border: 1px solid #cfe6da !important;
        box-shadow: 0px 4px 12px rgba(47, 133, 90, 0.2) !important;
    }

    /* ===== Judul ===== */
    .min-h-screen h2 {
        font-size: 42px !important;
        font-weight: 800 !important;
        letter-spacing: 1px;
        text-align: center;
        color: #1e6b4a !important;
        margin-bottom: 22px !important;
    }

    /* ===== Input label ===== */
    .min-h-screen label {
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #2f6f52 !important;
    }

    /* ===== Input ===== */
    .min-h-screen input {
        width: 100% !important;
        padding: 12px 14px !important;
        border-radius: 12px !important;
        border: 1px solid #b7dbc7 !important;
        background: #ffffff !important;
        font-size: 14px !important;
        outline: none !important;
        transition: .2s ease !important;
    }

    .min-h-screen input:focus {
        border-color: #4caf84 !important;
        box-shadow: 0 0 0 2px rgba(76, 175, 132, 0.35) !important;
    }

    /* ===== Tombol Login ===== */
    .min-h-screen button {
        width: 100% !important;
        padding: 11px !important;
        background: linear-gradient(135deg, #2f8f67, #3fa77c) !important;
        border-radius: 25px !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 16px !important;
        border: none !important;
        cursor: pointer !important;
        transition: .2s ease !important;
        box-shadow: 0 4px 8px rgba(47, 143, 103, 0.35) !important;
    }

    .min-h-screen button:hover {
        background: linear-gradient(135deg, #257b58, #2f8f67) !important;
    }

    .min-h-screen button:active {
        transform: scale(0.97);
    }

    /* ===== Text & link ===== */
    .min-h-screen p {
        font-size: 14px !important;
        color: #3f6f59 !important;
    }

    .min-h-screen a {
        color: #2f8f67 !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }

    .min-h-screen a:hover {
        text-decoration: underline !important;
    }

    /* ===== Alert Message ===== */
    .bg-green-100 {
        background: #dcf5e8 !important;
        color: #1e6b4a !important;
        border-radius: 10px !important;
        font-size: 14px !important;
    }

    .bg-red-100 {
        background: #fde2e2 !important;
        color: #8a1f1f !important;
        border-radius: 10px !important;
        font-size: 14px !important;
    }
</style>


<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">BioSave</h2>

        {{-- Pesan sukses/error --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required autofocus value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition">
                Login
            </button>

            <p class="text-sm text-center mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
            </p>
        </form>
    </div>
</div>
@endsection
