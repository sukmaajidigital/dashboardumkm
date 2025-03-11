<nav class="navbar bg-base-100 max-sm:rounded-box max-sm:shadow sm:border-b border-base-content/25 fixed top-0 left-0 right-0 z-50">
    <button type="button" class="btn btn-text max-sm:btn-square me-2" aria-haspopup="dialog" aria-expanded="false" aria-controls="default-sidebar" data-overlay="#default-sidebar" id="toggle-sidebar">
        <span class="icon-[tabler--menu-2] size-5"></span>
    </button>
    <div class="flex flex-1 items-center ">
        <a class="link text-base-content link-neutral text-xl font-semibold no-underline" href="#">
            {{ \App\Models\Setting::value('app_name') }}
        </a>
    </div>
</nav>
