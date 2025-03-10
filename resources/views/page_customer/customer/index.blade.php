<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('customer.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('customer.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable barisdata="10" filter1name="filter kategori" :filter1array="$customerkategoris" filter1collumn="nama_kategori" filter1colnumber="6" hiddenfilter1="" hiddenfilter2=" ">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Kategori</th>
                    <th>History Pembelian</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->nama_customer }}</td>
                        <td>{{ $customer->email }}</td>
                        <td class="whitespace-pre-wrap">{{ $customer->alamat }}</td>
                        <td>{{ $customer->telepon }}</td>
                        <td>{{ $customer->customerkategori->nama_kategori }}</td>
                        <td class="whitespace-pre-wrap">{{ $customer->history_pembelian }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('customer.edit', $customer->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('customer.destroy', $customer->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
</x-layouts>
