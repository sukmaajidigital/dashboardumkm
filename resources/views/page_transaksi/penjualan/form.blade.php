<x-forms.text-input dir="rtl" class="w-2/5" required="required" label="tanggal" id="tanggal" type="date" name="tanggal" :value="old('tanggal', $penjualan->tanggal ?? date('Y-m-d'))" />
<x-forms.text-input class="w-3/5" required="required" label="Nomor Invoice" id="invoicenumber" type="text" name="invoicenumber" :value="old('invoicenumber', $penjualan->invoicenumber ?? $generateInvoicePenjualanNumber)" readonly="readonly" />
<x-forms.select-input label="Customer" id="customer_id" :options="$customers" name="customer_id" required="required" :selected="old('customer_id', optional($penjualan ?? null)->customer_id)" optionname="nama_customer" />
<x-forms.select-input label="Sumber Transaksi" id="source_id" :options="$sources" name="source_id" required="required" :selected="old('source_id', optional($penjualan ?? null)->source_id)" optionname="sumber_transaksi" />
{{-- scanner qr --}}

<input type="text" id="scan_input" placeholder="Scan atau ketik ID Produk..." class="input max-w-sm mt-4">
<button type="button" id="start_camera" class="btn btn-secondary">Scan dengan Kamera</button>

<div id="qr-reader" style="width:300px;" class="mt-2 hidden"></div>
<div id="camera-status" class="mt-2 text-green-600 hidden">
    📷 Kamera aktif. Arahkan ke QR Code produk.
</div>

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
        @endif
    </tbody>
</table>
<button type="button" id="addRow" class="btn btn-primary mt-4">Tambah Baris</button>
<x-forms.text-input required="" label="Total Harga" id="total_harga" type="" name="total_harga" :value="old('total_harga', $penjualan->total_harga ?? '')" readonly="readonly" />
<x-forms.text-input required="" label="diskon" id="diskon" type="number" name="diskon" :value="old('diskon', $penjualan->diskon ?? '')" readonly />
<x-forms.text-input required="" label="Last Harga" id="last_total" type="number" name="last_total" :value="old('last_total', $penjualan->last_total ?? '')" readonly="readonly" />
