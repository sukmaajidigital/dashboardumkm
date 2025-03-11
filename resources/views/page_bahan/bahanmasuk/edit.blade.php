<form class="" action="{{ route('bahanmasuk.update', $bahanmasuk->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_bahan.bahanmasuk.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
