{{-- customer --}}
<x-forms.text-input required="required" label="Nama Kategori" id="nama_kategori" name="nama_kategori" :value="old('nama_kategori', $customerkategori->nama_kategori ?? '')" />
