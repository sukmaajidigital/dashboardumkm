<aside id="default-sidebar" class="fixed top-0 left-0 h-screen w-64 pt-16 shadow-md z-40 bg-base-100 rtl:left-auto rtl:right-0">
    <div class="drawer-body px-2 pt-4">
        <ul class="menu">
            <li>
                <a href="{{ route('setting') }}" class="{{ request()->routeIs('setting') ? 'active' : '' }} text-secondary ">
                    <span class="icon-[tabler--settings-filled] size-5"></span>
                    Setting
                </a>
            </li>
            <br>
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
            {{-- <br>
            <li class="progress">
                <div class="progress-bar progress-indeterminate progress-primary"></div>
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
            </li> --}}
        </ul>
    </div>
</aside>
