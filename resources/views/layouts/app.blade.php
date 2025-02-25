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
    <div id="app" class="min-h-screen flex flex-col">
        <div class="flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md h-screen fixed left-0 top-0">
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <a href="#" class="flex items-center">
                            <img src="{{ asset('assets/images/logos/mbklong.png') }}" width="225" alt="Logo" />
                        </a>
                        <button class="lg:hidden text-gray-600 focus:outline-none" id="sidebarCollapse">
                            <i class="ti ti-x text-xl"></i>
                        </button>
                    </div>
                    <nav class="mt-6">
                        <ul>
                            <li class="mb-4">
                                <span class="text-gray-500 text-sm uppercase">Home</span>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-layout-dashboard mr-2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="mt-6 mb-4">
                                <span class="text-gray-500 text-sm uppercase">MASTER DATA</span>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-box mr-2"></i>
                                    <span>Bahan</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-category mr-2"></i>
                                    <span>Kategori</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-news mr-2"></i>
                                    <span>Keperluan</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-user mr-2"></i>
                                    <span>Supplier</span>
                                </a>
                            </li>
                            <li class="mt-6 mb-4">
                                <span class="text-gray-500 text-sm uppercase">MASTER DATA</span>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-package mr-2"></i>
                                    <span>Bahan Masuk</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-package mr-2"></i>
                                    <span>Bahan Keluar</span>
                                </a>
                            </li>
                            <li class="mt-6 mb-4">
                                <span class="text-gray-500 text-sm uppercase">MANAJEMEN AKUN</span>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                                    <i class="ti ti-box mr-2"></i>
                                    <span>USER</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Header -->
                <header class="bg-white shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <button class="lg:hidden text-gray-600 focus:outline-none" id="headerCollapse">
                            <i class="ti ti-menu-2 text-xl"></i>
                        </button>
                        <div class="flex items-center">
                            <h6 class="text-gray-800">Hallo, kamu</h6>
                            <div class="ml-4 relative">
                                <button class="focus:outline-none" id="drop2">
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="Profile" class="w-8 h-8 rounded-full">
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden" id="dropdownMenu">
                                    <div class="p-4">
                                        <form method="POST" action="#">
                                            @csrf
                                            <button type="submit" class="w-full text-left text-gray-700 hover:bg-gray-100 p-2 rounded">
                                                <i class="ti ti-power mr-2"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Content -->
                <div class="container mx-auto p-6">
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                        <h4 class="text-lg font-semibold uppercase">
                            {{ Str::upper($title ?? '') }}
                        </h4>
                        {{ $formfilter ?? '' }}
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'warning',
                title: '{{ session('error') }}'
            });
        @elseif (session('info'))
            Swal.fire({
                icon: 'info',
                title: '{{ session('info') }}'
            });
        @elseif (session('delete'))
            Swal.fire({
                icon: 'success',
                title: '{{ session('delete') }}'
            });
        @endif
    </script>
    @stack('script')
</body>

<footer class="bg-white shadow-md mt-auto py-6 text-center">
    <p class="text-gray-600 text-sm">
        Design and Developed by
        <a href="https://sukmaajidigital.github.io/" target="_blank" class="text-yellow-500 underline">sukmaajidigital</a>
        Distributed by
        <a href="https://muriabatikkudus.com" target="_blank" class="text-blue-500 underline">muria batik kudus</a>
    </p>
</footer>

</html>
