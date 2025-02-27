<aside id="default-sidebar" class="fixed top-0 left-0 h-screen w-64 pt-16 bg-white shadow-md z-40">
    <div class="drawer-body px-2 pt-4">
        <ul class="menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="icon-[tabler--home] size-5"></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('customer.index') }}" class="{{ request()->routeIs('customer.index') ? 'active' : '' }}">
                    <span class="icon-[tabler--user] size-5"></span>
                    Pelanggan
                </a>
            </li>
            <li>
                <a href="{{ route('sampledata') }}" class="{{ request()->routeIs('sampledata') ? 'active' : '' }}">
                    <span class="icon-[tabler--user] size-5"></span>
                    Sample data
                </a>
            </li>
        </ul>
    </div>
</aside>
