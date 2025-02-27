@props(['title', 'routes'])
<button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="modalEdit" data-overlay="#modalEdit" onclick="loadEditForm('{{ $routes }}')">{{ $title }}</button>
