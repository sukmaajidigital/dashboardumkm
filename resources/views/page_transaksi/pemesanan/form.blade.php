<div class="flex flex-row gap-4">
    <x-forms.text-input dir="rtl" class="w-2/5" required="required" label="tanggal" id="tanggal" type="date" name="tanggal" :value="old('tanggal', $pemesanan->tanggal ?? date('Y-m-d'))" />
    <x-forms.text-input class="w-3/5" required="required" label="Nomor Invoice" id="invoicenumber" type="text" name="invoicenumber" :value="old('invoicenumber', $pemesanan->invoicenumber ?? $generateInvoicePemesananNumber)" readonly="readonly" />
</div>

<x-forms.select-input label="Customer" id="customer_id" :options="$customers" name="customer_id" required="required" :selected="old('customer_id', optional($pemesanan ?? null)->customer_id)" optionname="nama_customer" />
<x-forms.select-input label="Sumber Transaksi" id="source_id" :options="$sources" name="source_id" required="required" :selected="old('source_id', optional($pemesanan ?? null)->source_id)" optionname="sumber_transaksi" />
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
    <tbody id="detail_pemesanan">
        @if (isset($pemesananDetails) && count($pemesananDetails) > 0)
            @foreach ($pemesananDetails as $index => $detail)
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
<x-forms.text-input required="" label="Total Harga" id="total_harga" type="" name="total_harga" :value="old('total_harga', $pemesanan->total_harga ?? '')" readonly="readonly" />
<x-forms.text-input required="" label="diskon" id="diskon" type="number" name="diskon" :value="old('diskon', $pemesanan->diskon ?? '')" readonly />
<x-forms.text-input required="" label="Last Harga" id="last_total" type="number" name="last_total" :value="old('last_total', $pemesanan->last_total ?? '')" readonly="readonly" />
