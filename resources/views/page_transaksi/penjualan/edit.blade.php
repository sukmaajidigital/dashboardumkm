<form class="" action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_transaksi.penjualan.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
