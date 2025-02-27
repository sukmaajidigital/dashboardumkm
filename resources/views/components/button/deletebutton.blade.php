@props(['routes', 'confirmationMessage' => 'Are you sure?', 'title' => 'Delete'])
<div>
    <form action="{{ $routes }}" method="POST" onsubmit="return confirm('{{ $confirmationMessage }}')" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash"></i> {{ $title }}
        </button>
    </form>
</div>
