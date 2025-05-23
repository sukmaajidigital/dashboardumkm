<li class="space-y-0.5">
    <a class="collapse-toggle collapse-open:bg-base-content/10" id="menu-app" data-collapse="#menu-app-collapse">
        <span class="icon-[tabler--user-hexagon] size-5"></span>
        Pendataan Pelanggan
        <span class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
    </a>
    <ul id="menu-app-collapse" class="collapse {{ request()->routeIs('customerkategori.index', 'customer.index') ? 'block' : 'hidden' }}" aria-labelledby="menu-app">
        <li>
            <a href="{{ route('customerkategori.index') }}" class="{{ request()->routeIs('customerkategori.index') ? 'active' : '' }}">
                <span class="icon-[tabler--category-filled] size-5"></span>
                Kategori Pelanggan
            </a>
        </li>
        <li>
            <a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
                <span class="icon-[tabler--user] size-5"></span>
                Data Pelanggan
            </a>
        </li>
    </ul>
</li>
<li class="space-y-0.5">
    <a class="collapse-toggle collapse-open:bg-base-content/10" id="menu-bahan" data-collapse="#menu-bahan-collapse">
        <span class="icon-[tabler--needle-thread] size-5"></span>
        Pendataan bahan baku
        <span class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
    </a>
    <ul id="menu-bahan-collapse" class="collapse {{ request()->routeIs('bahankategori.index', 'bahan.index', 'keperluan.index', 'supplier.index', 'bahanmasuk.index', 'bahankeluar.index') ? 'block' : 'hidden' }}" aria-labelledby="menu-bahan">
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
</li>
<li class="space-y-0.5">
    <a class="collapse-toggle collapse-open:bg-base-content/10" id="menu-produk" data-collapse="#menu-produk-collapse">
        <span class="icon-[tabler--package] size-5"></span>
        Produk
        <span class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
    </a>
    <ul id="menu-produk-collapse" class="collapse {{ request()->routeIs('produkkategori.index', 'produk.index') ? 'block' : 'hidden' }}" aria-labelledby="menu-app">
        <li>
            <a href="{{ route('produkkategori.index') }}" class="{{ request()->routeIs('produkkategori.index') ? 'active' : '' }}">
                <span class="icon-[tabler--category] size-5"></span>
                Kategori Produk
            </a>
        </li>
        <li>
            <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
                <span class="icon-[tabler--package] size-5"></span>
                Data Produk
            </a>
        </li>
    </ul>
</li>
<li class="space-y-0.5">
    <a class="collapse-toggle collapse-open:bg-base-content/10" id="menu-transaksi" data-collapse="#menu-transaksi-collapse">
        <span class="icon-[tabler--user-hexagon] size-5"></span>
        Transaksi
        <span class="icon-[tabler--chevron-down] collapse-open:rotate-180 size-4 transition-all duration-300"></span>
    </a>
    <ul id="menu-transaksi-collapse" class="collapse {{ request()->routeIs('invoicesetting.index', 'source.index', 'penjualan.index', 'pemesanan.index', 'downpayment.index', 'manualinvoice.index') ? 'block' : 'hidden' }}" aria-labelledby="menu-app">
        <li>
            <a href="{{ route('invoicesetting.index') }}" class="{{ request()->routeIs('invoicesetting.index') ? 'active' : '' }}">
                <span class="icon-[tabler--settings] size-5"></span>
                Invoice Setting
            </a>
        </li>
        <li>
            <a href="{{ route('source.index') }}" class="{{ request()->routeIs('source.index') ? 'active' : '' }}">
                <span class="icon-[tabler--brand-open-source] size-5"></span>
                Sumber Transaksi
            </a>
        </li>
        <li>
            <a href="{{ route('penjualan.index') }}" class="{{ request()->routeIs('penjualan.index') ? 'active' : '' }}">
                <span class="icon-[material-symbols--point-of-sale] size-5"></span>
                Penjualan
            </a>
        </li>
        <li>
            <a href="{{ route('pemesanan.index') }}" class="{{ request()->routeIs('pemesanan.index') ? 'active' : '' }}">
                <span class="icon-[tabler--brand-booking] size-5"></span>
                Pemesanan
            </a>
        </li>
        <li>
            <a href="{{ route('manualinvoice.index') }}" class="{{ request()->routeIs('manualinvoice.index') ? 'active' : '' }}">
                <span class="icon-[tabler--brand-booking] size-5"></span>
                Manual Invoice
            </a>
        </li>
        <li>
            <a href="{{ route('downpayment.index') }}" class="{{ request()->routeIs('downpayment.index') ? 'active' : '' }}">
                <span class="icon-[tabler--device-ipad-horizontal-down] size-5"></span>
                Down Payment
            </a>
        </li>
    </ul>
</li>
