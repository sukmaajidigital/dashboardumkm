<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('bahan.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('bahan.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable tablename="bahan" barisdata="5" hiddenfilter1="" filter1name="kategori :" :filter1array="$bahankategoris" filter1collumn="nama_kategori" filter1colnumber="5" hiddenfilter2="true">
            <thead>
                <tr>
                    {{-- <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th> --}}
                    <th>ID</th>
                    <th>Nama Bahan</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahans as $bahan)
                    <tr>
                        {{-- <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td> --}}
                        <td>{{ $bahan->id }}</td>
                        <td>{{ $bahan->nama_bahan }}</td>
                        <td>{{ $bahan->stok }}</td>
                        <td>{{ $bahan->satuan }}</td>
                        <td>{{ $bahan->bahankategori->nama_kategori }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('bahan.edit', $bahan->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('bahan.destroy', $bahan->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
