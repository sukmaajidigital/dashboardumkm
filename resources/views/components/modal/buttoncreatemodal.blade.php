@props(['title', 'routes'])
<button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="modalTambah" data-overlay="#modalTambah" onclick="window.loadCreateForm('{{ $routes }}')">{{ $title }}</button>
