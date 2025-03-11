<x-forms.text-input required="required" label="tanggal" id="tanggal" type="date" name="tanggal" :value="old('tanggal', $bahankeluar->tanggal ?? '')" />

<x-forms.select-input label="Keperluan" id="keperluan_id" :options="$keperluans" name="keperluan_id" required="required" :selected="old('keperluan_id', optional($bahankeluar ?? null)->keperluan_id)" optionname="nama_keperluan" />

<x-forms.select-input label="Nama Bahan" id="bahan_id" :options="$bahans" name="bahan_id" required="required" :selected="old('bahan_id', optional($bahankeluar ?? null)->bahan_id)" jsvalue="data-stok" jscolname2="stok" optionname="nama_bahan" onchange="updateStok()" />

<x-forms.text-input label="stok" placeholder="sesuaikan dengan stok tersedia" id="stok" type="text" name="stok" required="required" :value="old('stok')" readonly="readonly" />

<x-forms.text-input label="jumlah" placeholder="1xxx" id="jumlah" type="number" name="jumlah" required="required" :value="old('jumlah', $bahankeluar->jumlah ?? '')" />

<x-forms.textarea-input label="Catatan" placeholder="Catatan ... .. " id="catatan" name="catatan" required="required" :value="old('catatan', $bahankeluar->catatan ?? '')" />
