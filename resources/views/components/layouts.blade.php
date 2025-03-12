<!doctype html>
<html lang="en" data-theme="{{ \App\Models\Setting::value('data_theme') }}" dir="{{ \App\Models\Setting::value('dir') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <meta name="title" content="{{ \App\Models\Setting::value('app_name') }}">
    <meta name="description" content="Sistem dashboard admin yang membantu Anda mengelola apapun.">
    <meta name="keywords" content="stok barang, manajemen stok, manajemen pelanggan, nomor surat">
    <meta name="author" content="Muria Batik Kudus">
    <meta name="robots" content="index, follow"> <!-- Izinkan mesin pencari mengindeks dan mengikuti tautan -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph (SEO untuk sosial media) -->
    <meta property="og:title" content="{{ \App\Models\Setting::value('app_name') }}">
    <meta property="og:description" content="Sistem dashboard admin yang membantu Anda mengelola apapun.">
    <meta property="og:image" content="{{ asset('storage/' . \App\Models\Setting::value('icon')) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card (SEO untuk Twitter) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ \App\Models\Setting::value('app_name') }}">
    <meta name="twitter:description" content="Sistem dashboard admin yang membantu Anda mengelola apapun.">
    <meta name="twitter:image" content="{{ asset('storage/' . \App\Models\Setting::value('icon')) }}">

    <!-- Canonical URL (Hindari duplikat konten di SEO) -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <title>{{ \App\Models\Setting::value('app_name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . \App\Models\Setting::value('icon')) }}" />

    <!-- Stylesheets -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/datatable/datatable.css') }}" />
    <link rel="stylesheet" href="{{ asset('custom/responsive.css') }}" />
</head>

<body class="flex flex-col min-h-screen">
    <x-header />
    <div dir="ltr" class="flex flex-1 rtl:flex-row-reverse" id="page-container">
        <x-sidebar />
        <main id="main-content" class="flex-1 p-2 overflow-auto max-h-screen sm:ml-64 rtl:sm:mr-64 pt-16 bg-base-200">
            <div class="card">
                @if (isset($header))
                    <div class="card-header">
                        <h2 class="font-semibold text-3xl text-secondary">
                            {{ $header }}
                        </h2>
                    </div>
                @endif
                {{ $slot }}
            </div>
            <x-footer class="mt-auto" />
        </main>
    </div>
    @vite('resources/js/app.js')
    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatable/datatable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/loadform.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/sidebar.js') }}"></script>
    @stack('script')
    @stack('componentscript')
</body>

</html>
