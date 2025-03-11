<form class="" action="{{ route('keperluan.update', $keperluan->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_bahan.keperluan.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
