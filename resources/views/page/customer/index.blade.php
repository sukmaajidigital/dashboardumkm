<x-layouts>
    <x-slot name="header">
        Customer
    </x-slot>
    <div class="card">
        <div class="card-header">
            <x-modal.createmodal id="modalTambah" title="Tambah Data" routes="{{ route('customer.store') }}">
                @include('page.customer.form')
            </x-modal.createmodal>
        </div>
        <div class="card-body">
            <table id="customers-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan diisi oleh DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    @push('script')
        <script>
            let table = $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('customer.data') }}",
                    data: function(d) {
                        d.kategori = $('#filter-kategori').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_customer',
                        name: 'nama_customer'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        </script>
    @endpush
</x-layouts>
