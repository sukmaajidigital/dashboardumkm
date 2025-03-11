{{-- customer --}}
<x-forms.text-input required="required" label="Nama Lengkap" id="nama_customer" name="nama_customer" :value="old('nama_customer', $customer->nama_customer ?? '')" />
{{-- email --}}
<x-forms.text-input required="required" label="Email" id="email" type="email" name="email" :value="old('email', $customer->email ?? '')" />
{{-- telepon --}}
<x-forms.text-input required="required" label="Telepon" id="telepon" type="text" name="telepon" :value="old('telepon', $customer->telepon ?? '')" />
{{-- customer kategori --}}
<x-forms.select-input required="required" label="Customer Kategori" id="customer_kategori_id" name="customer_kategori_id" :options="$customerkategoris" optionname="nama_kategori" :selected="old('customer_kategori_id', $customer->customer_kategori_id ?? '')" />
{{-- alamat --}}
<x-forms.textarea-input required="required" label="Alamat" id="alamat" name="alamat" :value="old('alamat', $customer->alamat ?? '')" />
{{-- history pembelian --}}
<x-forms.textarea-input required="" label="History Pembelian" id="history_pembelian" name="history_pembelian" :value="old('history_pembelian', $customer->history_pembelian ?? '')" />
