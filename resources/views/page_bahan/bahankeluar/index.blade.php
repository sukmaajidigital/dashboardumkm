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
                        <td>{{ $bahankeluar->bahan->kategori->nama_kategori }}</td>
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
                const selectedOption = bahanSelect.options[bahanSelect.selectedIndex];
                const stok = selectedOption.getAttribute('data-select');
                document.getElementById('stok').value = stok || 0;
            }
            document.addEventListener("DOMContentLoaded", function() {
                updateStok();
            });
        </script>
    @endpush
</x-layouts>
