<form class="" action="{{ route('customerkategori.update', $customerkategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_customer.kategori.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
