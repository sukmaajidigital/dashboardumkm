<!doctype html>
<html lang="en" data-theme="{{ \App\Models\Setting::value('data_theme') }}" dir="{{ \App\Models\Setting::value('dir') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <meta name="title" content="{{ \App\Models\Setting::value('app_name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical URL (Hindari duplikat konten di SEO) -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <title>{{ \App\Models\Setting::value('app_name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . \App\Models\Setting::value('icon')) }}" />

    <!-- Stylesheets -->
    @vite('resources/css/app.css')
</head>

<body>
    <div dir="ltr" class="flex flex-1">
        <main class="flex-1 p-2 max-h-screen">
            {{ $slot }}
            <x-footer class=" absolute w-full" />
        </main>
    </div>
    @vite('resources/js/app.js')
    @stack('script')
    @stack('componentscript')
</body>

</html>
