<form class="" action="{{ route('penjualan.store') }}" method="POST">
    @csrf
    <div class="card-header">
        <h3 class="">Tambah Penjualan</h3>
    </div>
    <div class="card-body">
        <div class="">
            @include('page_transaksi.penjualan.form')
        </div>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-soft btn-secondary" data-overlay="#modalTambah">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
