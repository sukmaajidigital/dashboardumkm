<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('keperluan.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('keperluan.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama keperluan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keperluans as $keperluan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $keperluan->nama_keperluan }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('keperluan.edit', $keperluan->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('keperluan.destroy', $keperluan->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
