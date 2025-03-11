<x-forms.select-input required="required" label="Nama Bahan" id="bahan_id" name="bahan_id" :options="$bahans" optionname="nama_bahan" :selected="old('bahan_id', $bahanmasuk->bahan_id ?? '')" />

<x-forms.text-input required="required" label="tanggal" id="tanggal" type="date" name="tanggal" :value="old('tanggal', $bahanmasuk->tanggal ?? '')" />

<x-forms.text-input required="required" label="jumlah" id="jumlah" type="number" name="jumlah" :value="old('jumlah', $bahanmasuk->jumlah ?? '')" />

<x-forms.textarea-input required="" label="Catatan" id="catatan" name="catatan" :value="old('catatan', $bahanmasuk->catatan ?? '')" />

<x-forms.select-input required="required" label="Supplier" id="supplier_id" name="supplier_id" :options="$suppliers" optionname="nama_supplier" :selected="old('supplier_id', $bahanmasuk->supplier_id ?? '')" />
