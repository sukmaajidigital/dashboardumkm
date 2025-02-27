@props(['title', 'size' => 'lg', 'routes'])
<div id="modalTambah" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100 modal-dialog-{{ $size }}">
        <div class="modal-content">
            <form class="" action="{{ $routes }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title">{{ $title }}</h3>
                    <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close" data-overlay="#modalTambah">
                        <span class="icon-[tabler--x] size-4"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body" id="createFormContainer">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft btn-secondary" data-overlay="#modalTambah">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
