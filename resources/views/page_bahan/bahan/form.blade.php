{{-- bahan --}}
<x-forms.text-input required="required" label="Nama bahan" id="nama_bahan" name="nama_bahan" :value="old('nama_bahan', $bahan->nama_bahan ?? '')" />
{{-- kategori --}}
<x-forms.select-input required="required" label="Satuan" id="satuan" name="satuan" :options="['kg' => 'Kg', 'meter' => 'Meter', 'unit' => 'Unit']" :selected="old('satuan', $bahan->satuan ?? '')" />

{{-- Stok --}}
<x-forms.text-input required="required" label="Stok" id="stok" name="stok" type="number" :value="old('stok', $bahan->stok ?? '')" />

{{-- Kategori --}}
<x-forms.select-input required="required" label="Kategori" id="bahan_kategori_id" name="bahan_kategori_id" :options="$bahankategoris" optionname="nama_kategori" :selected="old('bahan_kategori_id', $bahan->bahan_kategori_id ?? '')" />
