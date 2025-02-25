<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Informasi Pendataan Barang') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/mbk.png') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex flex-1">
        @include('layouts.header')
        @include('layouts.sidebar')
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
    @stack('script')
</body>
@include('layouts.footer')

</html>
