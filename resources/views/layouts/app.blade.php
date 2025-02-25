<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Informasi Pendataan Barang') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/mbk.png') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media (max-width: 768px) {
            #default-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            #default-sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <x-header />

    <!-- Main Layout -->
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-4 ml-64 pt-25">
            {{ $slot }}
            <x-footer />
        </main>

    </div>

    <!-- Footer -->


    @stack('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('[data-overlay="#default-sidebar"]');
            const sidebar = document.getElementById('default-sidebar');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
        });
    </script>
</body>

</html>
