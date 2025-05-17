@props(['title', 'routes'])
<button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="modalView" data-overlay="#modalView" onclick="window.loadViewForm('{{ $routes }}')">
    <span class="icon-[tabler--eye] size-8"></span>
    {{ $title }}</button>
