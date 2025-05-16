@props(['title', 'routes'])
<button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="subModalTambah" data-overlay="#subModalTambah" data-overlay="#ModalTambah" onclick="window.loadCreateSubForm('{{ $routes }}')">{{ $title }}</button>
