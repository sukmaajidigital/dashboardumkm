<!doctype html>
<html lang="en" data-theme="{{ \App\Models\Setting::value('data_theme') }}" dir="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::value('app_name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . \App\Models\Setting::value('icon')) }}" />
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

<body class="flex flex-col min-h-screen">
    <x-header />
    <div class="flex flex-1 rtl:flex-row-reverse">
        <!-- Sidebar -->
        <x-sidebar id="default-sidebar" class="" />
        <!-- Main Content -->
        <main dir="ltr" class="flex-1 p-2 overflow-auto max-h-screen sm:ml-64 rtl:ml-0 rtl:mr-64 pt-16 bg-base-200">
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
