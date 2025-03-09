<!doctype html>
<html lang="en" data-theme="light" dir="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistem Informasi Pendataan Barang') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/mbk.png') }}" />
    @vite('resources/css/app.css')
    <style>
        @media (max-width: 600px) {
            #default-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            #default-sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/datatable/datatable.css') }}" />
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <x-header />
    <div class="flex flex-1 rtl:flex-row-reverse">
        <!-- Sidebar -->
        <x-sidebar id="default-sidebar" class="shadow-md h-screen w-64 fixed sm:relative sm:translate-x-0 transform -translate-x-full transition-transform duration-300 z-50
            left-0 rtl:left-auto rtl:right-0" />

        <!-- Main Content -->
        <main dir="ltr" class="flex-1 p-4 overflow-auto max-h-screen sm:ml-64 rtl:ml-0 rtl:mr-64 pt-16 bg-base-200">
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
        </main>
    </div>
    <x-footer class="mt-auto" />

    @vite('resources/js/app.js')
    <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/datatable/datatable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/loadform.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/sidebar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('custom/theme.js') }}"></script>
    @stack('script')
    @stack('componentscript')
</body>

</html>
