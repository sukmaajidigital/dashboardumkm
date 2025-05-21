<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatesubmodal title="+ Customer" routes="{{ route('customer.create') }}" />
        <x-modal.buttoncreatesub2modal title="+ Produk" routes="{{ route('customer.create') }}" />
        @include('page_transaksi.penjualan.createform')
        <x-modal.createsub2modal title="Tambah Produk" routes="{{ route('customer.store') }}" />
        <x-modal.createsubmodal title="Tambah Customer" routes="{{ route('customer.store') }}" />
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
                                <x-modal.buttonviewmodal title="" routes="{{ route('penjualan.view', $penjualan->id) }}" />
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
        </script>
        <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>
                                <select name="produk_id[]" class="input max-w-sm produk-select">
                                    ${Object.values(produkData).map(p =>
                                        `<option value="${p.id}" data-harga="${p.harga}">${p.name}</option>`
                                    ).join('')}
                                </select>
                            </td>
                            <td><input type="number" name="qty[]" class="input max-w-sm qty" value="1"></td>
                            <td><input type="number" name="harga[]" class="input max-w-sm harga" value=""></td>
                            <td><input type="number" name="sub_harga[]" class="input max-w-sm sub_harga" value="" readonly></td>
                            <td><button type="button" class="remove-row btn btn-error rounded"><span class="icon-[tabler--x] size-5"></span></button></td>
                        `;
                        document.getElementById('detail_penjualan').appendChild(row);
                        attachRowEvents(row);
                    }
                    // Hapus baris
                    if (event.target.closest('.remove-row')) {
                        const rows = document.querySelectorAll('#detail_penjualan tr');
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
                const produkData = @json($produks->keyBy('id')); // Produk by ID
                const scanInput = document.getElementById('scan_input');

                function tambahProdukKeTabel(produkId) {
                    const produk = produkData[produkId];
                    if (!produk) {
                        alert("Produk tidak ditemukan");
                        return;
                    }
                    // Cek apakah produk sudah ada di tabel
                    const existingRow = Array.from(document.querySelectorAll('#detail_penjualan tr')).find(row => {
                        const select = row.querySelector('.produk-select');
                        return select && select.value === produkId;
                    });
                    if (existingRow) {
                        // Jika sudah ada, tambah qty-nya +1
                        const qtyInput = existingRow.querySelector('.qty');
                        qtyInput.value = parseInt(qtyInput.value || 0) + 1;
                        updateSubHarga(existingRow);
                        updateTotal();
                        return;
                    }
                    // Jika belum ada, tambahkan baris baru
                    const row = document.createElement('tr');
                    row.innerHTML = `
        <td>
            <select name="produk_id[]" class="input max-w-sm produk-select">
                ${Object.values(produkData).map(p =>
                    `<option value="${p.id}" data-harga="${p.harga}" ${p.id == produkId ? 'selected' : ''}>${p.name}</option>`
                ).join('')}
            </select>
        </td>
        <td><input type="number" name="qty[]" class="input max-w-sm qty" value="1"></td>
        <td><input type="number" name="harga[]" class="input max-w-sm harga" value="${produk.harga}"></td>
        <td><input type="number" name="sub_harga[]" class="input max-w-sm sub_harga" value="${produk.harga}" readonly></td>
        <td>
            <button type="button" class="remove-row btn btn-error rounded">
                <span class="icon-[tabler--x] size-5"></span>
            </button>
        </td>
    `;
                    document.getElementById('detail_penjualan').appendChild(row);
                    // Trigger hitung total
                    row.querySelector('.produk-select').dispatchEvent(new Event('change'));

                    // Attach event agar qty/harga dihitung ulang
                    row.querySelector('.qty').addEventListener('input', () => updateSubHarga(row));
                    row.querySelector('.harga').addEventListener('input', () => updateSubHarga(row));
                    row.querySelector('.produk-select').addEventListener('change', function() {
                        const selected = this.selectedOptions[0];
                        row.querySelector('.harga').value = selected.getAttribute('data-harga');
                        updateSubHarga(row);
                    });
                    updateTotal();
                }
                // Deteksi input dari alat scanner biasa (yang menekan Enter)
                scanInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        let val = scanInput.value.trim();
                        const match = val.match(/^produk:(.+)$/);
                        if (match) {
                            tambahProdukKeTabel(match[1]);
                        } else {
                            tambahProdukKeTabel(val); // fallback: kalau ID langsung
                        }
                        scanInput.value = '';
                    }
                });
                // Kamera scanner
                let html5QrCode;
                let isCameraRunning = false;
                const cameraStatus = document.getElementById('camera-status');
                document.getElementById('start_camera').addEventListener('click', () => {
                    const qrRegion = document.getElementById('qr-reader');
                    qrRegion.classList.remove('hidden');

                    if (!html5QrCode) {
                        html5QrCode = new Html5Qrcode("qr-reader");
                    }

                    if (isCameraRunning) {
                        html5QrCode.stop().then(() => {
                            isCameraRunning = false;
                            qrRegion.classList.add('hidden');
                            cameraStatus.classList.add('hidden');
                        });
                        return;
                    }
                    let lastScanTime = 0;
                    html5QrCode.start({
                            facingMode: "environment"
                        }, {
                            fps: 10,
                            qrbox: 250
                        },
                        (decodedText) => {
                            const currentTime = new Date().getTime();
                            if (currentTime - lastScanTime > 1000) { // Limit scan to 1 per second
                                lastScanTime = currentTime;
                                const match = decodedText.trim().match(/^produk:(.+)$/);
                                if (match) {
                                    const produkId = match[1];
                                    tambahProdukKeTabel(produkId);
                                    scanInput.value = '';
                                } else {
                                    alert("QR tidak valid.");
                                }
                            }
                        },
                        (errorMessage) => {
                            // ignore QR scan errors
                        }
                    ).then(() => {
                        isCameraRunning = true;
                        cameraStatus.classList.remove('hidden');
                    }).catch(err => {
                        console.error("Camera error", err);
                    });
                });
            });
        </script>
    @endpush
</x-layouts>
