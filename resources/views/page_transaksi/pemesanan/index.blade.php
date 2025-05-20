<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatesub2modal title="+ Produk" routes="{{ route('customer.create') }}" />
        <x-modal.createsub2modal title="Tambah Produk" routes="{{ route('customer.store') }}" />

        <x-modal.buttoncreatesubmodal title="+ Customer" routes="{{ route('customer.create') }}" />
        <x-modal.createsubmodal title="Tambah Customer" routes="{{ route('customer.store') }}" />

        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('pemesanan.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('pemesanan.store') }}" />
        <x-modal.editmodal title="Edit Data" />
        <x-modal.viewmodal title="View Data" />
    </div>
    <div class="card-body">
        <x-table.datatable barisdata="20" hiddenfilter1=" " hiddenfilter2=" ">
            <thead>
                <tr>
                    {{-- <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th> --}}
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Sumber Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Nomor Invoice</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemesanans as $pemesanan)
                    <tr>
                        {{-- <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemesanan->tanggal }}</td>
                        <td>{{ $pemesanan->source->sumber_transaksi }}</td>
                        <td>{{ $pemesanan->customer->nama_customer }}</td>
                        <td>{{ $pemesanan->invoicenumber }}</td>
                        <td>{{ 'Rp. ' . number_format($pemesanan->last_total, 0, ',', '.') }}</td>
                        <td>{{ $pemesanan->status }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttonviewmodal title="" routes="{{ route('pemesanan.view', $pemesanan->id) }}" />
                                <x-modal.buttoneditmodal title="" routes="{{ route('pemesanan.edit', $pemesanan->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('pemesanan.destroy', $pemesanan->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
    @push('script')
        <script>
            function loadCreateSubForm(url, containerId = '#createSubFormContainer', errorMessage = 'Failed to load the create form.') {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $(containerId).html(response);
                    },
                    error: function() {
                        alert(errorMessage);
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', function mainInit() {
                function updateSubHarga(row) {
                    let qty = parseInt(row.querySelector('.qty').value) || 0;
                    let harga = parseFloat(row.querySelector('.harga').value) || 0;
                    row.querySelector('.sub_harga').value = qty * harga;
                    updateTotal();
                }

                function updateTotal() {
                    let total = 0;
                    document.querySelectorAll('.sub_harga').forEach(el => total += parseFloat(el.value) || 0);
                    document.getElementById('total_harga').value = total;
                    let diskon = parseFloat(document.getElementById('diskon').value) || 0;
                    document.getElementById('last_total').value = total - diskon;
                }

                document.addEventListener('change', function(event) {
                    if (event.target.classList.contains('produk-select')) {
                        let selectedOption = event.target.selectedOptions[0];
                        let harga = selectedOption.getAttribute('data-harga');
                        let row = event.target.closest('tr');
                        row.querySelector('.harga').value = harga;
                        updateSubHarga(row);
                    }
                });

                document.addEventListener('input', function(event) {
                    if (event.target.classList.contains('qty')) {
                        updateSubHarga(event.target.closest('tr'));
                    }
                    if (event.target.classList.contains('harga')) {
                        updateSubHarga(event.target.closest('tr'));
                    }
                    if (event.target.id === 'diskon') {
                        updateTotal();
                    }
                });
                // add row event
                document.addEventListener('click', function(event) {
                    // Tambah baris
                    if (event.target.id === 'addRow') {
                        let newRow = document.querySelector('#detail_pemesanan tr').cloneNode(true);

                        // Reset semua input dan select
                        newRow.querySelectorAll('input').forEach(input => input.value = '');
                        newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

                        // Aktifkan tombol remove
                        newRow.querySelector('.remove-row').disabled = false;

                        document.getElementById('detail_pemesanan').appendChild(newRow);
                    }

                    // Hapus baris
                    if (event.target.closest('.remove-row')) {
                        const rows = document.querySelectorAll('#detail_pemesanan tr');
                        if (rows.length > 1) {
                            event.target.closest('tr').remove();
                            updateTotal(); // fungsi ini diasumsikan menghitung ulang subtotal / total
                        }
                    }
                });

                function attachRowEvents(row) {
                    row.querySelector('.produk-select').addEventListener('change', function() {
                        let selectedOption = this.selectedOptions[0];
                        let harga = selectedOption.getAttribute('data-harga');
                        let row = this.closest('tr');
                        row.querySelector('.harga').value = harga;
                        updateSubHarga(row);
                    });

                    row.querySelector('.qty').addEventListener('input', function() {
                        updateSubHarga(this.closest('tr'));
                    });
                }
            });
        </script>
    @endpush
</x-layouts>
