<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('produk.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('produk.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable tablename="produk" barisdata="20" hiddenfilter1="" filter1name="kategori :" :filter1array="$produkkategoris" filter1collumn="nama_kategori" filter1colnumber="5" hiddenfilter2="true">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Stock</th>
                    {{-- <th>Marketplace</th> --}}
                    {{-- <th>SEO</th> --}}
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
                        {{-- <td>
                            @if ($produk->shopee)
                                <a href="{{ $produk->shopee }}" target="_blank" class="text-blue-500 hover:underline">Shopee</a><br>
                            @endif
                            @if ($produk->tokped)
                                <a href="{{ $produk->tokped }}" target="_blank" class="text-green-500 hover:underline">Tokopedia</a><br>
                            @endif
                            @if ($produk->tiktokshop)
                                <a href="{{ $produk->tiktokshop }}" target="_blank" class="text-pink-400 hover:underline">TikTok</a>
                            @endif
                            @if (!$produk->shopee && !$produk->tokped && !$produk->tiktokshop)
                                <span class="text-gray-400">-</span>
                            @endif
                        </td> --}}
                        {{-- <td>
                            <strong>Meta Title:</strong> {{ $produk->meta_title ?? '-' }}<br>
                            <strong>Meta Desc:</strong> {{ \Illuminate\Support\Str::limit($produk->meta_description, 30) ?? '-' }}<br>
                            <strong>Meta Keywords:</strong> {{ $produk->meta_keywords ?? '-' }}
                        </td> --}}
                        <td>
                            @if ($produk->kategoris->count())
                                <ul class="list-disc list-inside">
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
                                <x-modal.buttoneditmodal title="Add Variasi" routes="{{ route('produk.variasi.update', $produk->id) }}" />
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
