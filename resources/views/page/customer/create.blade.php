<form class="" action="{{ route('customer.store') }}" method="POST">
    @csrf
    @include('page.customer.form')
</form>
