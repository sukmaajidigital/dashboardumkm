<x-forms.select-input label="Penjualan" id="penjualan_id" :options="$penjualans" name="penjualan_id" required="required" :selected="old('penjualan_id', optional($downpayment ?? null)->penjualan_id)" optionname="invoicenumber" />

<x-forms.select-input label="Pemesanan" id="pemesanan_id" :options="$pemesanans" name="pemesanan_id" required="required" :selected="old('pemesanan_id', optional($downpayment ?? null)->pemesanan_id)" optionname="invoicenumber" />

<x-forms.text-input required="required" label="tanggal" id="tanggal" type="date" name="tanggal" :value="old('tanggal', $downpayment->tanggal ?? '')" />

<x-forms.text-input required="" label="Total Down Payment" id="nominal" type="number" name="nominal" :value="old('nominal', $downpayment->nominal ?? '')" readonly="readonly" />
