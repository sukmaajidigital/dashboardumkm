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
            <div id="datatable-filter" class="bg-base-100 flex flex-col rounded-md ">
                <div class="border-base-content/25 flex items-center border-b px-5 py-3 gap-3">
                    <div class="input-group max-w-[15rem]">
                        <span class="input-group-text">
                            <span class="icon-[tabler--search] text-base-content size-4"></span>
                        </span>
                        <input type="search" class="input input-sm grow" id="filter-search" placeholder="Search for items" />
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-3">
                        <select id="select-paginate" class="input input-sm advance-select-sm w-16 justify-between">
                            <option value="1">1</option>
                            @for ($i = 5; $i <= 50; $i += 5)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <label for="select-kategori">filter kategori</label>
                        <select id="select-kategori" class="input input-sm advance-select-sm w-36 justify-between">
                            <option value="">All</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="horizontal-scrollbar overflow-x-auto">
                    <table id="datatable" class="table min-w-full">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Kategori</th>
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
                                    <td>{{ $customer->alamat }}</td>
                                    <td>{{ $customer->telepon }}</td>
                                    <td>{{ $customer->kategori->nama_kategori }}</td>
                                    <td>
                                        <div class="flex flex-1 items-center  gap-3">
                                            <x-modal.buttoneditmodal title="Edit Data" routes="{{ route('customer.edit', $customer->id) }}" />
                                            <x-button.deletebutton title="Delete" routes="{{ route('customer.destroy', $customer->id) }}" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                var table = $('#datatable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    scrollX: true,
                    searching: true,
                    lengthChange: false,
                    pageLength: 5,
                    columnDefs: [{
                        orderable: false,
                        targets: 0,
                    }, {
                        orderable: false,
                        targets: 7
                    }]
                });

                $('#filter-search').on('keyup', function() {
                    table.search(this.value).draw();
                });

                $('#select-kategori').on('change', function() {
                    table.column(6).search(this.value).draw();
                });

                $('#select-paginate').on('change', function() {
                    table.page.len(this.value).draw();
                });

                $('#select-all').on('click', function() {
                    $('.row-checkbox').prop('checked', this.checked);
                });
            });
        </script>
    @endpush
</x-layouts>
