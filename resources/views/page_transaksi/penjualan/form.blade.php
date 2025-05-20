<div class="flex flex-row gap-4">
    <x-forms.text-input dir="rtl" class="w-2/5" required="required" label="tanggal" id="tanggal" type="date" name="tanggal" :value="old('tanggal', $penjualan->tanggal ?? date('Y-m-d'))" />
    <x-forms.text-input class="w-3/5" required="required" label="Nomor Invoice" id="invoicenumber" type="text" name="invoicenumber" :value="old('invoicenumber', $penjualan->invoicenumber ?? $generateInvoicePenjualanNumber)" readonly="readonly" />
</div>

<x-forms.select-input label="Customer" id="customer_id" :options="$customers" name="customer_id" required="required" :selected="old('customer_id', optional($penjualan ?? null)->customer_id)" optionname="nama_customer" />
<x-forms.select-input label="Sumber Transaksi" id="source_id" :options="$sources" name="source_id" required="required" :selected="old('source_id', optional($penjualan ?? null)->source_id)" optionname="sumber_transaksi" />
{{-- scanner qr --}}
<div class="flex gap-4 mt-4 items-center">
    <input type="text" id="scan_input" placeholder="Scan atau ketik ID Produk..." class="input max-w-sm">
    <button type="button" id="start_camera" class="btn btn-secondary">Scan dengan Kamera</button>
</div>
<div id="qr-reader" style="width:300px;" class="mt-2"></div>

<table class="w-full mt-10">
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
        @if (isset($penjualanDetails) && count($penjualanDetails) > 0)
            @foreach ($penjualanDetails as $index => $detail)
                <tr>
                    <td class="mb-2">
                        <select name="produk_id[]" class="input max-w-sm produk-select">
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}" {{ old('produk_id.' . $index, $detail->produk_id) == $produk->id ? 'selected' : '' }}>{{ $produk->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="qty[]" class="input max-w-sm qty" value="{{ old('qty.' . $index, $detail->qty) }}" aria-label="input"></td>
                    <td><input type="number" name="harga[]" class="input max-w-sm harga" value="{{ old('harga.' . $index, $detail->harga) }}" aria-label="input"></td>
                    <td><input type="number" name="sub_harga[]" class="input max-w-sm sub_harga" value="{{ old('sub_harga.' . $index, $detail->sub_harga) }}" aria-label="input" readonly></td>
                    <td><button type="button" class="remove-row btn btn-error rounded"><span class="icon-[tabler--x] size-5"></span></button></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>
                    <select name="produk_id[]" class="input max-w-sm produk-select">
                        @foreach ($produks as $produk)
                            <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="qty[]" class="input max-w-sm qty" aria-label="input"></td>
                <td><input type="number" name="harga[]" class="input max-w-sm harga" aria-label="input"></td>
                <td><input type="number" name="sub_harga[]" class="input max-w-sm sub_harga" aria-label="input" readonly></td>
                <td>
                    <button type="button" class="remove-row btn btn-error rounded">
                        <span class="icon-[tabler--x] size-5"></span>
                    </button>
                </td>
            </tr>
        @endif
    </tbody>
</table>
<button type="button" id="addRow" class="btn btn-primary mt-4">Tambah Baris</button>
<x-forms.text-input required="" label="Total Harga" id="total_harga" type="" name="total_harga" :value="old('total_harga', $penjualan->total_harga ?? '')" readonly="readonly" />
<x-forms.text-input required="" label="diskon" id="diskon" type="number" name="diskon" :value="old('diskon', $penjualan->diskon ?? '')" readonly />
<x-forms.text-input required="" label="Last Harga" id="last_total" type="number" name="last_total" :value="old('last_total', $penjualan->last_total ?? '')" readonly="readonly" />


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
