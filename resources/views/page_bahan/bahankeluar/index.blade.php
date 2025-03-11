<x-layouts>
    <div class="card-header">
        <x-modal.buttoncreatemodal title="Tambah Data" routes="{{ route('bahankeluar.create') }}" />
        <x-modal.createmodal title="Tambah Data" routes="{{ route('bahankeluar.store') }}" />
        <x-modal.editmodal title="Edit Data" />
    </div>
    <div class="card-body">
        <x-table.datatable tablename="bahankeluar" barisdata="5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Bahan</th>
                    <th>Kategori Bahan</th>
                    <th>Jumlah</th>
                    <th>Keperluan</th>
                    <th>Catatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahankeluars as $bahankeluar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $bahankeluar->tanggal }}</td>
                        <td>{{ $bahankeluar->bahan->nama_bahan }}</td>
                        <td>{{ $bahankeluar->bahan->bahankategori->nama_kategori }}</td>
                        <td>{{ $bahankeluar->jumlah }}</td>
                        <td>{{ $bahankeluar->keperluan->nama_keperluan }}</td>
                        <td>{{ $bahankeluar->catatan }}</td>
                        <td>
                            <div class=" flex items-center gap-3">
                                <x-modal.buttoneditmodal title="" routes="{{ route('bahankeluar.edit', $bahankeluar->id) }}" />
                                <x-button.deletebutton title="" routes="{{ route('bahankeluar.destroy', $bahankeluar->id) }}" confirmationMessage="data ini tidak dapat dikembalikan lagi" />
                            </div>
                        </td>
                @endforeach
            </tbody>
        </x-table.datatable>
    </div>
    @push('script')
        <script>
            function updateStok() {
                const bahanSelect = document.getElementById('bahan_id');
                if (!bahanSelect) {
                    // console.warn("Elemen dengan id 'bahan_id' tidak ditemukan.");
                    return;
                }
                const selectedOption = bahanSelect.options[bahanSelect.selectedIndex];
                if (!selectedOption) {
                    // console.warn("Tidak ada opsi yang dipilih di elemen 'bahan_id'.");
                    return;
                }
                const stok = selectedOption.getAttribute('data-select');
                if (!stok) {
                    // console.warn("Atribut 'data-select' tidak ditemukan pada opsi yang dipilih.");
                }
                const stokInput = document.getElementById('stok');
                if (!stokInput) {
                    // console.warn("Elemen dengan id 'stok' tidak ditemukan.");
                    return;
                }
                stokInput.value = stok || 0;
            }
            document.addEventListener("DOMContentLoaded", function() {
                updateStok();
            });
        </script>
    @endpush
</x-layouts>
