<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('bahankategori.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('bahankategori.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable barisdata="10" hiddenfilter1=" " hiddenfilter2=" ">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th>
                    <th>Id</th>
                    <th>Nama Kategori</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahankategoris as $bahankategori)
                    <tr>
                        <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td>
                        <td>{{ $bahankategori->id }}</td>
                        <td>{{ $bahankategori->nama_kategori }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('bahankategori.edit', $bahankategori->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('bahankategori.destroy', $bahankategori->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
