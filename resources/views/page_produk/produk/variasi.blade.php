<form class="" action="{{ route('produk.variasi.store', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div id="variasi-wrapper" class="space-y-6">
        {{-- Menampilkan variasi yang sudah ada --}}
        @forelse ($produk->variasi as $index => $variasi)
            <div class="border p-4 rounded-lg bg-base-100 shadow space-y-2">
                {{-- Nama Variasi --}}
                <input type="hidden" name="existing_ids[]" value="{{ $variasi->id }}">
                <x-forms.text-input required label="Nama Variasi" id="existing_nama_variasi" name="existing_nama_variasi[{{ $variasi->id }}]" :value="$variasi->nama_variasi" />

                {{-- Gambar Saat Ini --}}
                <div class="flex items-center gap-4 mt-2">
                    <img src="{{ asset('storage/' . $variasi->image) }}" alt="Variasi Image" class="w-24 h-24 object-cover rounded">
                    <div>
                        <label class="block mb-1">Ganti Gambar (Opsional)</label>
                        <input type="file" name="existing_image[{{ $variasi->id }}]" accept="image/*">
                    </div>
                </div>

                {{-- Checkbox hapus --}}
                <label class="flex items-center gap-2 mt-2 text-sm">
                    <input type="checkbox" name="delete_variasi[]" value="{{ $variasi->id }}">
                    Hapus variasi ini
                </label>
            </div>
        @empty
            <p class="text-sm text-gray-500 italic">Belum ada variasi.</p>
        @endforelse

        {{-- Form untuk menambahkan variasi baru --}}
        <div class="variasi-form border p-4 rounded-lg bg-base-100 shadow">
            <x-forms.text-input required label="Nama Variasi" id="nama_variasi" :value="old('nama_variasi')" name="nama_variasi[]" />
            <x-forms.text-input required type="file" id="image" label="Gambar Produk" name="image[]" onchange="previewImage(event, this)" :value="old('image')" />

            <div class="mt-4">
                <img src="#" alt="Preview Gambar" class="w-32 h-32 object-cover rounded hidden" />
            </div>
        </div>
    </div>

    {{-- Tombol tambah variasi --}}
    <button type="button" class="btn btn-outline btn-sm mt-4 " onclick="addVariasiForm()">+ Tambah Variasi</button>

    <script>
        function previewImage(event, input) {
            const reader = new FileReader();
            const preview = input.closest('.variasi-form').querySelector('img');
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function addVariasiForm() {
            const wrapper = document.getElementById('variasi-wrapper');
            const form = wrapper.querySelector('.variasi-form');
            const clone = form.cloneNode(true);
            // Kosongkan input
            clone.querySelector('input[name="nama_variasi[]"]').value = '';
            clone.querySelector('input[name="image[]"]').value = '';
            clone.querySelector('img').src = '#';
            clone.querySelector('img').classList.add('hidden');

            wrapper.appendChild(clone);
        }
    </script>
    <div class="modal-footer">
        <button type="button" class="btn btn-soft btn-secondary" data-overlay="#modalTambah">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
