<form class="" action="{{ route('manualinvoice.update', $manualinvoice->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_transaksi.manualinvoice.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
