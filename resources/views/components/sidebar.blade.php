<aside id="default-sidebar" class="fixed top-0 left-0 h-screen w-64 pt-16 shadow-md z-40 bg-base-100 flex flex-col rtl:left-auto rtl:right-0">
    <!-- Navigasi Sidebar (Scrollable) -->
    <div id="sidebar-content" class="flex-1 overflow-y-auto px-2 pt-4">
        <ul class="menu space-y-1">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }} ">
                    <span class="icon-[tabler--home-filled] size-5"></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('customerkategori.index') }}" class="{{ request()->routeIs('customerkategori.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--category-filled] size-5"></span>
                    Kategori Pelanggan
                </a>
            </li>
            <li>
                <a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--user] size-5"></span>
                    Pelanggan
                </a>
            </li>
            <li>
                <a href="{{ route('bahankategori.index') }}" class="{{ request()->routeIs('bahankategori.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--category] size-5"></span>
                    Kategori bahan
                </a>
            </li>
            <li>
                <a href="{{ route('bahan.index') }}" class="{{ request()->routeIs('bahan.index') ? 'active' : '' }}">
                    <span class="icon-[lets-icons--materials] size-5"></span>
                    Bahan
                </a>
            </li>
            <li>
                <a href="{{ route('keperluan.index') }}" class="{{ request()->routeIs('keperluan.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--needle-thread] size-5"></span>
                    Keperluan
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--user-down] size-5"></span>
                    Supplier
                </a>
            </li>
            <li>
                <a href="{{ route('bahanmasuk.index') }}" class="{{ request()->routeIs('bahanmasuk.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--package-import] size-5"></span>
                    Bahan Masuk
                </a>
            </li>
            <li>
                <a href="{{ route('bahankeluar.index') }}" class="{{ request()->routeIs('bahankeluar.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--package-export] size-5"></span>
                    Bahan Keluar
                </a>
            </li>
        </ul>
    </div>

    <!-- Footer User (Tetap di bawah) -->
    <div class="dropdown relative inline-flex rtl:[--placement:bottom-end] justify-center px-4 py-10">
        <button id="dropdown-avatar" type="button" class="dropdown-toggle" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <li class="dropdown-header gap-3">
                <div class="avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-3.png" alt="User Avatar" />
                    </div>
                </div>
                <div>
                    <h6 class="text-base-content text-base font-semibold">{{ Auth::user()->name }}</h6>
                    <small class="text-base-content/50 text-sm font-normal">{{ Auth::user()->email }}</small>
                </div>
            </li>
            <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
        </button>
        <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-avatar">
            <li class="dropdown-header gap-3">
                <div class="avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-3.png" alt="User Avatar" />
                    </div>
                </div>
                <div>
                    <h6 class="text-base-content text-base font-semibold">{{ Auth::user()->name }}</h6>
                    <small class="text-base-content/50 text-sm font-normal">{{ Auth::user()->email }}</small>
                </div>
            </li>
            <li><a class="dropdown-item" href="#">My Profile</a></li>
            <li>
                <a href="{{ route('setting') }}" class="{{ request()->routeIs('setting') ? 'active' : '' }} dropdown-item ">
                    <span class="icon-[tabler--settings] size-5"></span>
                    Setting
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="btn btn-danger mx-3 mt-2 d-block" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <span class="icon-[tabler--logout] size-4"></span>Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>
</aside>
