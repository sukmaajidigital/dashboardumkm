<form class="" action="{{ route('bahankategori.update', $bahankategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_bahan.kategori.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
