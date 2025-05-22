<li>
    <a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
        <span class="icon-[tabler--user] size-5"></span>
        Data Pelanggan
    </a>
</li>
<li>
    <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
        <span class="icon-[tabler--package] size-5"></span>
        Data Produk
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
{{-- <li>
    <a href="{{ route('manualinvoice.index') }}" class="{{ request()->routeIs('manualinvoice.index') ? 'active' : '' }}">
        <span class="icon-[tabler--brand-booking] size-5"></span>
        Manual Invoice
    </a>
</li> --}}
