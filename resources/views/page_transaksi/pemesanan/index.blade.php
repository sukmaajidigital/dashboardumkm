<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('pemesanan.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('pemesanan.store') }}" />
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
            document.addEventListener('DOMContentLoaded', function() {
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
                document.addEventListener('click', function(event) {
                    if (event.target.id === 'addRow') {
                        let newRow = document.querySelector('#detail_pemesanan tr').cloneNode(true);
                        newRow.querySelectorAll('input').forEach(input => input.value = '');
                        newRow.querySelector('.remove-row').disabled = false;
                        document.getElementById('detail_pemesanan').appendChild(newRow);
                    }
                    if (event.target.classList.contains('remove-row')) {
                        if (document.querySelectorAll('#detail_pemesanan tr').length > 1) {
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
            document.addEventListener('shown.bs.modal', function(event) {
                if (event.target.id === 'nodalTambah') {
                    document.getElementById('total_harga').value = 0;
                    document.getElementById('last_total').value = 0;
                }
            });
        </script>
    @endpush
</x-layouts>
