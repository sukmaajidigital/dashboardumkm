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
                    <th><input type="checkbox" id="select-all" class="checkbox checkbox-sm"></th>
                    <th>Id</th>
                    <th>Sumber Transaksi</th>
                    <th>Nomor Invoice</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualans as $penjualan)
                    <tr>
                        <td><input type="checkbox" class="row-checkbox checkbox checkbox-sm"></td>
                        <td>{{ $penjualan->id }}</td>
                        <td>{{ $penjualan->nama_kategori }}</td>
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

                document.getElementById('addRow').addEventListener('click', function() {
                    let newRow = document.querySelector('#detail_penjualan tr').cloneNode(true);
                    newRow.querySelectorAll('input').forEach(input => input.value = '');
                    newRow.querySelector('.remove-row').disabled = false;
                    document.getElementById('detail_penjualan').appendChild(newRow);
                });

                document.getElementById('detail_penjualan').addEventListener('input', function(event) {
                    if (event.target.classList.contains('qty') || event.target.classList.contains('harga')) {
                        updateSubHarga(event.target.closest('tr'));
                    }
                });

                document.getElementById('diskon').addEventListener('input', updateTotal);

                document.getElementById('detail_penjualan').addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-row')) {
                        if (document.querySelectorAll('#detail_penjualan tr').length > 1) {
                            event.target.closest('tr').remove();
                            updateTotal();
                        }
                    }
                });
            });
        </script>
    @endpush

</x-layouts>
