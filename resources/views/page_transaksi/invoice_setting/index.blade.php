<x-layouts>
    <div class="flex flex-col md:flex-row gap-6 p-6" id="aboutsetting">
        <div class="w-full h-full md:w-3/5 rounded-2xl p-6">
            <h5 class="text-2xl font-bold text-gray-700 mb-4">Invoice Setting</h5>
            <form action="{{ route('invoicesetting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <h5 class="text-xl font-bold text-gray-700 mb-10 mt-12">Header Invoice</h5>
                <x-forms.text-input label="Nama Perusahaan" id="name_invoice" name="name_invoice" type="text" :value="old('name_invoice', $invoicesetting->name_invoice ?? '')" required="" />

                <x-forms.text-input label="Logo" id="logo_invoice" name="logo_invoice" type="file" :value="old('logo_invoice', $invoicesetting->logo_invoice ?? '')" required="" />

                <x-forms.textarea-input required="" label="Alamat" id="address" name="address" :value="old('address', $invoicesetting->address ?? '')" />

                <x-forms.text-input label="No Telepon" id="phone" name="phone" type="text" :value="old('phone', $invoicesetting->phone ?? '')" required="" />

                <x-forms.text-input label="Email" id="email" name="email" type="text" :value="old('email', $invoicesetting->email ?? '')" required="" />

                <x-forms.text-input label="Website" id="website" name="website" type="text" :value="old('website', $invoicesetting->website ?? '')" required="" />

                <x-forms.text-input label="Instagram" id="instagram" name="instagram" type="text" :value="old('instagram', $invoicesetting->instagram ?? '')" required="" />

                <h5 class="text-xl font-bold text-gray-700 mb-10 mt-12">Detail Tanda Tangan</h5>

                <x-forms.text-input label="Tanda Tangan" id="ttd_image" name="ttd_image" type="file" :value="old('ttd_image', $invoicesetting->ttd_image ?? '')" required="" />

                <x-forms.text-input label="No Telepon" id="ttd_name" name="ttd_name" type="text" :value="old('ttd_name', $invoicesetting->ttd_name ?? '')" required="" />

                <x-forms.text-input label="Jabatan" id="ttd_position" name="ttd_position" type="text" :value="old('ttd_position', $invoicesetting->ttd_position ?? '')" required="" />

                <div class="mt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">Update</button>
                </div>
            </form>
        </div>
        <div class="w-full md:w-2/5  rounded-2xl p-6">
            <h5 class="text-2xl font-bold text-gray-700 mb-4">Preview</h5>
            <div class="space-y-6">
                <div>
                    <h6 class="font-semibold text-gray-600 mb-2">Logo Invoice</h6>
                    @if (!empty($invoicesetting->logo_invoice))
                        <img src="{{ asset('storage/' . $invoicesetting->logo_invoice) }}" alt="Icon" class="object-cover ">
                    @else
                        <div class="w-40 h-40 flex items-center justify-center rounded-lg border border-gray-300 bg-gray-100">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif

                </div>
            </div>
            <div class="space-y-6">
                <div>
                    <h6 class="font-semibold text-gray-600 mb-2">Tanda Tangan</h6>
                    @if (!empty($invoicesetting->ttd_image))
                        <img src="{{ asset('storage/' . $invoicesetting->ttd_image) }}" alt="Icon" class="object-cover ">
                    @else
                        <div class="w-40 h-40 flex items-center justify-center rounded-lg border border-gray-300 bg-gray-100">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-layouts>
