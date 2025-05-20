<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('produk.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('produk.store') }}" />
        <x-modal.editmodal title="Edit Data" />
        <a href="{{ route('produk.qrprint') }}" target="_blank" class="btn btn-success">
            <span class="icon-[tabler--printer] mr-1"></span> Cetak QR Produk
        </a>
    </div>
    <div class="card-body">
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
                                <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->name }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 flex items-center justify-center border rounded text-gray-400 text-xs">
                                    No Image
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="font-bold">{{ $produk->id }} . {{ $produk->name }} ( {{ $produk->sku ?? '-' }} )</div>
                            <div class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($produk->description, 50) }}</div>
                            <div class="text-green-600 font-semibold mt-1">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </div>
                        </td>
                        <td>{{ $produk->stock }}</td>
                        <td>
                            @if ($produk->kategoris->count())
                                <ul class="">
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
                                <x-modal.buttoneditmodal title="Edit" routes="{{ route('produk.edit', $produk->id) }}" />
                                <x-button.deletebutton title="Delete" routes="{{ route('produk.destroy', $produk->id) }}" confirmationMessage="Apakah anda yakin ingin menghapus produk ini?" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
