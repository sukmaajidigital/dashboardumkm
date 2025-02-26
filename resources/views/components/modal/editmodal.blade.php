@props(['id', 'title', 'size' => 'lg', 'routes'])
<button type="button" class="btn btn-primary" aria-haspopup="dialog" aria-expanded="false" aria-controls="{{ $id }}" data-overlay="#{{ $id }}">{{ $title }}</button>
<div id="{{ $id }}" class="overlay modal overlay-open:opacity-100" role="dialog" tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100 modal-dialog-{{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ $title }}</h3>
                <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close" data-overlay="#{{ $id }}">
                    <span class="icon-[tabler--x] size-4"></span>
                </button>
            </div>
            <form class="" action="{{ $routes }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body" id="modal-body-{{ $id }}">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft btn-secondary" data-overlay="#{{ $id }}">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
