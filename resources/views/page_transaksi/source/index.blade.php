<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('source.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('source.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable barisdata="10" hiddenfilter1=" " hiddenfilter2=" ">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Sumber Transaksi</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sources as $source)
                    <tr>
                        <td>{{ $source->id }}</td>
                        <td>{{ $source->sumber_transaksi }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('source.edit', $source->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('source.destroy', $source->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
