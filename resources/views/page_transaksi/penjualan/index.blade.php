<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('penjualan.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('penjualan.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable barisdata="10" hiddenfilter1=" " hiddenfilter2=" ">
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
                @foreach ($penjualans as $penjualan)
                    <tr>
                        {{-- <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penjualan->tanggal }}</td>
                        <td>{{ $penjualan->source->sumber_transaksi }}</td>
                        <td>{{ $penjualan->customer->nama_customer }}</td>
                        <td>{{ $penjualan->invoicenumber }}</td>
                        <td>{{ 'Rp. ' . number_format($penjualan->last_total, 0, ',', '.') }}</td>
                        <td>{{ $penjualan->status }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('penjualan.edit', $penjualan->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('penjualan.destroy', $penjualan->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fungsi untuk mengupdate harga ketika produk dipilih
                function setupProdukInputEvents() {
                    document.querySelectorAll('.produk-input').forEach(input => {
                        input.addEventListener('change', function() {
                            const selectedOption = document.querySelector('#produkList option[value="' + this.value + '"]');
                            if (selectedOption) {
                                const row = this.closest('tr');
                                row.querySelector('.harga').value = selectedOption.dataset.harga;
                                updateSubHarga(row);
                            }
                        });
                    });
                }

                // Inisialisasi event listener untuk produk input
                setupProdukInputEvents();

                function updateSubHarga(row) {
                    let qty = row.querySelector('.qty').value || 0;
                    let harga = row.querySelector('.harga').value || 0;
                    row.querySelector('.sub_harga').value = qty * harga;
                    updateTotal();
                }

                function updateTotal() {
                    let total = 0;
                    document.querySelectorAll('.sub_harga').forEach(el => total += parseInt(el.value || 0));
                    document.getElementById('total_harga').value = total;
                    let diskon = document.getElementById('diskon').value || 0;
                    document.getElementById('last_total').value = total - diskon;
                }

                document.getElementById('addRow').addEventListener('click', function() {
                    let newRow = document.querySelector('#detail_penjualan tr').cloneNode(true);
                    newRow.querySelectorAll('input').forEach(input => input.value = '');
                    newRow.querySelector('.remove-row').disabled = false;
                    document.getElementById('detail_penjualan').appendChild(newRow);

                    // Setup event listener untuk input produk yang baru ditambahkan
                    newRow.querySelector('.produk-input').addEventListener('change', function() {
                        const selectedOption = document.querySelector('#produkList option[value="' + this.value + '"]');
                        if (selectedOption) {
                            const row = this.closest('tr');
                            row.querySelector('.harga').value = selectedOption.dataset.harga;
                            updateSubHarga(row);
                        }
                    });
                });

                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-row')) {
                        if (document.querySelectorAll('#detail_penjualan tr').length > 1) {
                            event.target.closest('tr').remove();
                            updateTotal();
                        }
                    }
                });

                document.addEventListener('input', function(event) {
                    if (event.target.classList.contains('qty') || event.target.classList.contains('harga')) {
                        updateSubHarga(event.target.closest('tr'));
                    }
                });

                document.getElementById('diskon').addEventListener('input', updateTotal);
            });
        </script>
    @endpush
</x-layouts>
