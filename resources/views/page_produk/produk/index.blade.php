<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('produk.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('produk.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        {{-- Desktop Table --}}
        <div class="hidden md:block">
            <x-table.datatable tablename="produk" barisdata="20" hiddenfilter1="true" filter1name="kategori :" :filter1array="$produkkategoris" filter1collumn="nama_kategori" filter1colnumber="4" hiddenfilter2="true">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Stock</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $produk)
                        <tr>
                            <td>
                                @if (!empty($produk->image))
                                    <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->name }}" class="w-28 h-28 object-cover rounded">
                                @else
                                    <div class="w-16 h-16 flex items-center justify-center border rounded text-gray-400 text-xs">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="font-bold">{{ $produk->id }} . {{ $produk->name }}</div>
                                <div class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($produk->description, 50) }}</div>
                                <div class="text-green-600 font-semibold mt-1">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </div>
                            </td>
                            <td>{{ $produk->stock }}</td>
                            <td>
                                @if ($produk->kategoris->count())
                                    <ul>
                                        @foreach ($produk->kategoris as $kategori)
                                            <li>{{ $kategori->nama_kategori }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    @include('page_produk.produk.modalqrprint', ['route' => route('produk.qrprint', $produk->id), 'id' => $produk->id])
                                    <x-modal.buttoneditmodal title="Edit" routes="{{ route('produk.edit', $produk->id) }}" />
                                    <x-button.deletebutton title="Delete" routes="{{ route('produk.destroy', $produk->id) }}" confirmationMessage="Apakah anda yakin ingin menghapus produk ini?" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.datatable>
        </div>

        {{-- Mobile / Tablet Card View --}}
        {{-- Input Search --}}
        <div class="md:hidden space-y-4">
            <input type="text" id="mobileSearchInput" placeholder="Cari produk..." class="input input-bordered w-full" />
        </div>

        {{-- Mobile / Tablet Card View --}}
        <div class="md:hidden space-y-4" id="mobileProdukList">
            @foreach ($produks as $produk)
                <div class="produk-card border rounded-lg shadow p-4 flex flex-col sm:flex-row sm:items-start gap-4" data-name="{{ strtolower($produk->name) }}" data-description="{{ strtolower($produk->description) }}">
                    {{-- Gambar --}}
                    <div class="flex-shrink-0">
                        @if (!empty($produk->image))
                            <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->name }}" class="w-32 h-32 object-cover rounded">
                        @else
                            <div class="w-32 h-32 flex items-center justify-center border rounded text-gray-400 text-xs">
                                No Image
                            </div>
                        @endif
                    </div>

                    {{-- Detail Produk --}}
                    <div class="flex-1">
                        <div class="font-bold">{{ $produk->id }} . {{ $produk->name }}</div>
                        <div class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($produk->description, 50) }}</div>
                        <div class="text-green-600 font-semibold mt-1">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </div>

                        <div class="mt-2 text-sm">
                            <span class="font-semibold">Stock:</span> {{ $produk->stock }}
                        </div>
                        <div class="text-sm">
                            <span class="font-semibold">Kategori:</span>
                            @if ($produk->kategoris->count())
                                <ul class="list-disc ml-5">
                                    @foreach ($produk->kategoris as $kategori)
                                        <li>{{ $kategori->nama_kategori }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2">
                            @include('page_produk.produk.modalqrprint', ['route' => route('produk.qrprint', $produk->id), 'id' => $produk->id])
                            <x-modal.buttoneditmodal title="Edit" routes="{{ route('produk.edit', $produk->id) }}" />
                            <x-button.deletebutton title="Delete" routes="{{ route('produk.destroy', $produk->id) }}" confirmationMessage="Apakah anda yakin ingin menghapus produk ini?" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @push('script')
        <script>
            document.getElementById('mobileSearchInput').addEventListener('input', function() {
                const query = this.value.toLowerCase();
                document.querySelectorAll('.produk-card').forEach(function(card) {
                    const name = card.getAttribute('data-name');
                    const description = card.getAttribute('data-description');
                    const show = name.includes(query) || description.includes(query);
                    card.style.display = show ? 'block' : 'none';
                });
            });
        </script>
    @endpush
</x-layouts>
