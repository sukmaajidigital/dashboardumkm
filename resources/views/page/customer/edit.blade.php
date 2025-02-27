<form class="" action="{{ route('customer.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')
    @include('page.customer.form')
</form>
