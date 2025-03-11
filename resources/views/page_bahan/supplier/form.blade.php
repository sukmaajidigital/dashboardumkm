<x-forms.text-input label="Nama Supplier" placeholder="nama supplier" id="nama_supplier" type="text" name="nama_supplier" required="required" :value="old('nama_supplier', $supplier->nama_supplier ?? '')" />

<x-forms.text-input label="Nomor Telepon" placeholder="085xxxxxx" id="nomor" type="text" name="nomor" required="required" :value="old('nomor', $supplier->nomor ?? '')" />

<x-forms.textarea-input label="Alamat" placeholder="alamat....." id="alamat" name="alamat" required="required" :value="old('alamat', $supplier->alamat ?? '')" />
