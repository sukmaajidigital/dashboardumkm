<form class="" action="{{ route('bahan.update', $bahan->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_bahan.bahan.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
