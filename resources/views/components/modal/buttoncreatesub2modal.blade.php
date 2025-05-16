@props(['title', 'routes'])
<button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="sub2ModalTambah" data-overlay="#sub2ModalTambah" data-overlay="#ModalTambah" onclick="window.loadCreateSub2Form('{{ $routes }}')">{{ $title }}</button>
