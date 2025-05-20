{{-- customer --}}
<x-forms.text-input required="required" label="Nama Kategori" id="nama_kategori" name="nama_kategori" :value="old('nama_kategori', $produkkategori->nama_kategori ?? '')" />
<x-forms.text-input required="" label="Slug" id="slug" name="slug" :value="old('slug', $produkkategori->slug ?? '')" />
