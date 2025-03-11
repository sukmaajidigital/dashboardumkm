<x-layouts>
    {{-- add diff gabut --}}
    {{-- <div class="w-full md:w-5/5 rounded-2xl p-6">
        <div class="diff">
            <div class="diff-item-1">
                <div class="bg-primary text-base-200 grid place-content-center text-4xl sm:text-7xl font-black">{{ \App\Models\Setting::value('app_name') }}</div>
            </div>
            <div class="diff-item-2">
                <div class="bg-base-200 grid place-content-center text-4xl sm:text-7xl font-black">{{ \App\Models\Setting::value('app_name') }}</div>
            </div>
            <div class="diff-resizer"></div>
        </div>
    </div> --}}
    <div class="flex flex-col md:flex-row gap-6 p-6">
        <!-- Card Kiri (Form Setting) -->
        <div class="w-full md:w-3/5 rounded-2xl p-6">
            <h5 class="text-xl font-semibold mb-4">Setting</h5>
            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-forms.text-input required="required" label="Nama Aplikasi" id="app_name" name="app_name" type="text" :value="old('app_name', $setting->app_name ?? '')" />
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:w-1/2 rounded-2xl mr-2">
                        <x-forms.select-input required="required" label="Tema Tampilan" id="theme-selector" name="data_theme" :selected="old('data_theme', $setting->data_theme ?? '')" />
                    </div>
                    <div class="w-full md:w-1/2 rounded-2xl">
                        <x-forms.select-input required="required" label="Direction Tampilan" id="direction-selector" name="dir" :selected="old('dir', $setting->dir ?? '')" />
                    </div>
                </div>
                <x-forms.text-input required="" label="Logo" id="logo" name="logo" type="file" :value="old('logo', $setting->logo ?? '')" />
                <x-forms.text-input required="" label="Icon" id="icon" name="icon" type="file" :value="old('icon', $setting->icon ?? '')" />

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

        <!-- Card Kanan (Tampilan Foto) -->
        <div class="w-full md:w-2/5 rounded-2xl p-6 flex flex-col">
            <h5 class="text-xl font-semibold mb-4">Icon Image</h5>
            @if (!empty($setting->icon))
                <img src="{{ asset('storage/' . $setting->icon) }}" alt="" class="object-cover rounded-lg ">
            @else
                <div class="w-40 h-40 flex items-center justify-center  rounded-lg border">
                    <span class="text-secondary">No Image</span>
                </div>
            @endif
            <h5 class="text-xl font-semibold mb-4">Logo Image</h5>
            @if (!empty($setting->icon))
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="" class="object-cover rounded-lg ">
            @else
                <div class="w-40 h-40 flex items-center justify-center  rounded-lg border">
                    <span class="text-secondary">No Image</span>
                </div>
            @endif
        </div>
    </div>

    @push('script')
        <script type="text/javascript" src="{{ asset('custom/theme.js') }}"></script>
    @endpush
</x-layouts>
