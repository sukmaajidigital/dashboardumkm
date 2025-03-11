<x-layouts>
    <x-slot name="header">
        Dashboard
    </x-slot>
    <div class="card-body">
        <div class="w-full  bg-gray-100 rounded-lg overflow-hidden">
            @if (!empty($setting->logo))
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="" class="h-40 object-cover rounded-lg w-full">
            @else
                <div class="w-40 h-40 flex items-center justify-center  rounded-lg border">
                    <span class="text-secondary">No Image</span>
                </div>
            @endif
        </div>
    </div>
</x-layouts>
