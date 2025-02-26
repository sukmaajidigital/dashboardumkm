<x-layouts>
    <x-slot name="header">
        Customer
    </x-slot>
    <div class="card">
        <div class="card-header">
            <x-modal.createmodal id="modalTambah" title="Tambah Data" routes="{{ route('customer.store') }}">
                @include('page.customer.form')
            </x-modal.createmodal>
        </div>
        <div class="card-body">
            <table id="customers-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->nama }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->telepon }}</td>
                            <td>
                                <x-modal.editmodal id="modaledit" title="Edit" routes="{{ route('customer.edit', $customer->id) }}">
                                    @include('page.customer.form')
                                </x-modal.editmodal>
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts>
