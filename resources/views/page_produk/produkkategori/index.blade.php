<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('produkkategori.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('produkkategori.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable barisdata="10" hiddenfilter1=" " hiddenfilter2=" ">
            <thead>
                <tr>
                    {{-- <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th> --}}
                    <th>Id</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produkkategoris as $produkkategori)
                    <tr>
                        {{-- <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td> --}}
                        <td>{{ $produkkategori->id }}</td>
                        <td>{{ $produkkategori->nama_kategori }}</td>
                        <td>{{ $produkkategori->slug ?? 'null' }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('produkkategori.edit', $produkkategori->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('produkkategori.destroy', $produkkategori->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
