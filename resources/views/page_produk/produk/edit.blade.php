<form class="" action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('page_postingan.produk.form')
    <div class="modal-footer">
        <button type="button" class="btn btn-soft btn-secondary" data-overlay="#modalTambah">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
