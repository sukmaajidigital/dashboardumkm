<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('supplier.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('supplier.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama supplier</th>
                    <th>Nomor Telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->nama_supplier }}</td>
                        <td>{{ $supplier->nomor }}</td>
                        <td class="whitespace-pre-wrap">{{ $supplier->alamat }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('supplier.edit', $supplier->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('supplier.destroy', $supplier->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
