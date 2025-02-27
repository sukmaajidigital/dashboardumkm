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
    {{-- <link href="{{ asset('assets/dist/css/datatables.min.css') }}" rel="stylesheet"> --}}
</head>

<body class="bg-gray-100">
    <x-header />
    <div class="flex">
        <x-sidebar />
        <main class="flex-1 p-4 ml-64 pt-25 overflow-scroll h-[calc(100vh-64px)] min-h-[calc(100%-64px)]">
            <div class="px-1">
                @if (isset($header))
                    <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                        {{ $header }}
                    </h2>
                @endif
                {{ $slot }}
            </div>
            <x-footer />
        </main>
    </div>
    {{-- <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../node_modules/datatables.net/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/dist/js/datatables.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('[data-overlay="#default-sidebar"]');
            const sidebar = document.getElementById('default-sidebar');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
            });
        });
    </script>
    @stack('script')
    <script>
        function loadEditForm(url) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#editFormContainer').html(response);
                },
                error: function() {
                    alert('Failed to load the edit form.');
                }
            });
        }

        function loadCreateForm(url) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#createFormContainer').html(response);
                },
                error: function() {
                    alert('Failed to load the edit form.');
                }
            });
        }
    </script>
</body>

</html>
