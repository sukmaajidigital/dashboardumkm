<div class="mb-4">
    <label for="tanggal" class="block text-sm font-medium">Tanggal</label>
    <input type="date" id="tanggal" name="tanggal" class="w-full border rounded p-2" required>
</div>
<div class="mb-4">
    <label for="invoicenumber" class="block text-sm font-medium">Nomor Invoice</label>
    <input type="text" id="invoicenumber" name="invoicenumber" class="w-full border rounded p-2" required>
</div>
<div class="mb-4">
    <label for="customer_id" class="block text-sm font-medium">Customer</label>
    <select id="customer_id" name="customer_id" class="w-full border rounded p-2" required>
        @foreach ($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->nama_customer }}</option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label for="source_id" class="block text-sm font-medium">Source</label>
    <select id="source_id" name="source_id" class="w-full border rounded p-2" required>
        @foreach ($sources as $source)
            <option value="{{ $source->id }}">{{ $source->nama_source }}</option>
        @endforeach
    </select>
</div>

<h3 class="text-lg font-semibold mt-4">Detail Penjualan</h3>
<table class="w-full mt-2 border">
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Sub Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="detail_penjualan">
        <tr>
            <td><input type="text" name="nama_produk[]" class="border p-2"></td>
            <td><input type="number" name="qty[]" class="border p-2 qty"></td>
            <td><input type="number" name="harga[]" class="border p-2 harga"></td>
            <td><input type="number" name="sub_harga[]" class="border p-2 sub_harga" readonly></td>
            <td><button type="button" class="remove-row bg-red-500 text-white px-2 py-1 rounded" disabled>Hapus</button></td>
        </tr>
    </tbody>
</table>
<button type="button" id="addRow" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Tambah Baris</button>

<div class="mt-4">
    <label for="total_harga" class="block text-sm font-medium">Total Harga</label>
    <input type="number" id="total_harga" name="total_harga" class="w-full border rounded p-2" readonly>
</div>
<div class="mt-4">
    <label for="diskon" class="block text-sm font-medium">Diskon</label>
    <input type="number" id="diskon" name="diskon" class="w-full border rounded p-2">
</div>
<div class="mt-4">
    <label for="last_total" class="block text-sm font-medium">Last Harga</label>
    <input type="number" id="last_total" name="last_total" class="w-full border rounded p-2" readonly>
</div>

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
