<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BioSave')</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- GLOBAL CSS --}}
    <link rel="stylesheet" href="{{ asset('asset/global.css') }}">

     {{-- CSS PER HALAMAN --}}
    @yield('styles')
</head>
<body>

<div class="page-wrapper">
    @include('components.navbar')

    <main class="flex-grow-1">
        @yield('content')
    </main>

    @include('components.footer')
</div>

{{-- BOOTSTRAP JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
