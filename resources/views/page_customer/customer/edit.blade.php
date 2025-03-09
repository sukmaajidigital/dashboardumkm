<form class="" action="{{ route('customer.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page_customer.customer.form')
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
