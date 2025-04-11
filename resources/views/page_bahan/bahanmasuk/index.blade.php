<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('bahanmasuk.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('bahanmasuk.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable tablename="bahanmasuk" barisdata="5" hiddenfilter1="" filter1name="kategori :" :filter1array="$bahankategoris" filter1collumn="nama_kategori" filter1colnumber="5" hiddenfilter2="" filter2name="Supplier :" :filter2array="$suppliers" filter2collumn="nama_supplier" filter2colnumber="7">
            <thead>
                <tr>
                    {{-- <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th> --}}
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Nama Bahan</th>
                    <th>Kategori Bahan</th>
                    <th>Catatan</th>
                    <th>Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahanmasuks as $bahanmasuk)
                    <tr>
                        {{-- <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td> --}}

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bahanmasuk->tanggal }}</td>
                        <td>{{ $bahanmasuk->jumlah }}</td>
                        <td>{{ $bahanmasuk->bahan->nama_bahan }}</td>
                        <td>{{ $bahanmasuk->bahan->bahankategori->nama_kategori }}</td>
                        <td>
                            <p>{{ $bahanmasuk->catatan }}</p>
                        </td>
                        <td>{{ $bahanmasuk->supplier->nama_supplier }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('bahanmasuk.edit', $bahanmasuk->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('bahanmasuk.destroy', $bahanmasuk->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
