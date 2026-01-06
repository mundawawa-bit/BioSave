<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BioSave</title>

    <link rel="stylesheet" href="{{ asset('asset/global.css') }}">

    @yield('styles')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="admin-wrapper">

        @include('components.sidebar')

        <div class="main-content">

            @include('components.header-admin')

            <div class="content-scroll">
                @yield('content')
            </div>

        </div>

    </div>

</body>
</html>
