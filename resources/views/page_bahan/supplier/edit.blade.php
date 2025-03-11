<form class="" action="{{ route('supplier.update', $supplier->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_bahan.supplier.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
