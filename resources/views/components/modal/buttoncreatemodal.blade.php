@props(['title', 'routes'])
<button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="modalTambah" data-overlay="#modalTambah" onclick="loadCreateForm('{{ $routes }}')">{{ $title }}</button>
