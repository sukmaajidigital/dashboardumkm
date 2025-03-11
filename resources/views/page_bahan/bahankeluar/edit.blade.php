<form class="" action="{{ route('bahankeluar.update', $bahankeluar->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_bahan.bahankeluar.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
