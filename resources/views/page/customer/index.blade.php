<x-layouts>
    <x-slot name="header">
        Customer
    </x-slot>
    <div class="card">
        <div class="card-header">
            <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('customer.create') }}" />
            <x-modal.createmodal title="Tambah Data" routes="{{ route('customer.store') }}" />
            <x-modal.editmodal title="Edit Data" />
        </div>
        <div class="card-body">
            <table id="customers-table" class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->nama_customer }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->alamat }}</td>
                            <td>{{ $customer->telepon }}</td>
                            <td>{{ $customer->kategori_id }}</td>
                            <td>
                                <x-modal.buttoneditmodal title="Edit Data" routes="{{ route('customer.edit', $customer->id) }}" />
                                <x-button.deletebutton title="Delete" routes="{{ route('customer.destroy', $customer->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('script')
        <script>
            window.addEventListener('load', () => {
                ...

                const inputs = document.querySelectorAll('.dt-container thead input');

                inputs.forEach((input) => {
                    input.addEventListener('keydown', function(evt) {
                        if ((evt.metaKey || evt.ctrlKey) && evt.key === 'a') this.select();
                    });
                });
            });
        </script>
    @endpush
</x-layouts>
