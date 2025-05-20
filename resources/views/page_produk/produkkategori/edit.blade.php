<form class="" action="{{ route('produkkategori.update', $produkkategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_postingan.produkkategori.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
