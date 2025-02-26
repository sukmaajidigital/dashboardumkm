<x-forms.text-input label="Nama Lengkap" placeholder="nama lengkap" id="nama_customer" name="nama_customer" :value="old('nama_customer', $customer->nama ?? '')" />

<x-forms.text-input label="Email" placeholder="example@email.com" id="email" type="email" name="email" :value="old('email', $customer->email ?? '')" />

<x-forms.text-input label="Telepon" placeholder="08123456789" id="telepon" type="text" name="telepon" :value="old('telepon', $customer->telepon ?? '')" />

<x-forms.select-input label="Kategori" id="kategori_id" name="kategori_id" :options="$kategoris->pluck('nama_kategori', 'id')" :selected="old('kategori', $customer->kategori_id ?? '')" />

<x-forms.textarea-input label="Alamat" placeholder="alamat ....." id="alamat" name="alamat" :value="old('alamat', $customer->alamat ?? '')" />
