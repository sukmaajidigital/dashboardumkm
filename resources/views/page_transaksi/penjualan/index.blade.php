<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatesub2modal title="+ Produk" routes="{{ route('customer.create') }}" />
        <x-modal.createsub2modal title="Tambah Produk" routes="{{ route('customer.store') }}" />

        <x-modal.buttoncreatesubmodal title="+ Customer" routes="{{ route('customer.create') }}" />
        <x-modal.createsubmodal title="Tambah Customer" routes="{{ route('customer.store') }}" />

        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('penjualan.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('penjualan.store') }}" />
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
        <script src="https://unpkg.com/html5-qrcode@2.3.10"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const produkData = @json($produks->keyBy('id')); // Produk by ID
                const scanInput = document.getElementById('scan_input');

                function tambahProdukKeTabel(produkId) {
                    const produk = produkData[produkId];
                    if (!produk) {
                        alert("Produk tidak ditemukan");
                        return;
                    }

                    let newRow = document.querySelector('#detail_penjualan tr').cloneNode(true);
                    newRow.querySelector('.produk-select').value = produkId;
                    newRow.querySelector('.harga').value = produk.harga;
                    newRow.querySelector('.qty').value = 1;
                    newRow.querySelector('.sub_harga').value = produk.harga;

                    document.getElementById('detail_penjualan').appendChild(newRow);
                    document.querySelector('.produk-select:last-of-type').dispatchEvent(new Event('change'));
                }

                // Deteksi input dari alat scanner biasa (yang menekan Enter)
                scanInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        let val = scanInput.value.trim();
                        tambahProdukKeTabel(val);
                        scanInput.value = '';
                    }
                });

                // Kamera scanner
                let html5QrCode;
                document.getElementById('start_camera').addEventListener('click', () => {
                    const qrRegion = document.getElementById('qr-reader');
                    qrRegion.classList.remove('hidden');

                    if (!html5QrCode) {
                        html5QrCode = new Html5Qrcode("qr-reader");
                    }

                    html5QrCode.start({
                            facingMode: "environment"
                        }, {
                            fps: 10,
                            qrbox: 250
                        },
                        (decodedText) => {
                            tambahProdukKeTabel(decodedText.trim());
                            html5QrCode.stop();
                            qrRegion.classList.add('hidden');
                        },
                        (errorMessage) => {
                            // console.log("QR Error", errorMessage);
                        }
                    );
                });
            });
        </script>
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
                        let newRow = document.querySelector('#detail_penjualan tr').cloneNode(true);

                        // Reset semua input dan select
                        newRow.querySelectorAll('input').forEach(input => input.value = '');
                        newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

                        // Aktifkan tombol remove
                        newRow.querySelector('.remove-row').disabled = false;

                        document.getElementById('detail_penjualan').appendChild(newRow);
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
            });
            // document.getElementById('qr_scan_input').addEventListener('change', function(e) {
            //     let qrData = e.target.value.trim();
            //     let produkId = qrData.replace('produk:', '');

            //     if (!produkId) return;

            //     fetch(`/api/produk/${produkId}`)
            //         .then(res => res.json())
            //         .then(produk => {
            //             if (!produk || !produk.id) {
            //                 alert('Produk tidak ditemukan.');
            //                 return;
            //             }

            //             // Tambahkan produk ke tabel
            //             let newRow = document.querySelector('#detail_penjualan tr').cloneNode(true);

            //             newRow.querySelectorAll('input').forEach(input => input.value = '');
            //             newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

            //             // Set produk & harga
            //             let select = newRow.querySelector('.produk-select');
            //             for (let i = 0; i < select.options.length; i++) {
            //                 if (select.options[i].value == produk.id) {
            //                     select.selectedIndex = i;
            //                     break;
            //                 }
            //             }

            //             let harga = produk.harga || 0;
            //             newRow.querySelector('.harga').value = harga;
            //             newRow.querySelector('.qty').value = 1;
            //             newRow.querySelector('.sub_harga').value = harga;

            //             // Tambah baris ke table
            //             document.getElementById('detail_penjualan').appendChild(newRow);
            //             updateTotal(); // fungsi yg sudah ada

            //             // Reset input scan
            //             e.target.value = '';
            //         })
            //         .catch(() => alert('Gagal mengambil data produk.'));
            // });
        </script>
    @endpush
</x-layouts>
