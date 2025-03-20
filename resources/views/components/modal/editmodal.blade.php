@props(['title'])
<div id="modalEdit" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100 modal-dialog-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ $title }}</h3>
                <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close" data-overlay="#modalEdit">
                    <span class="icon-[tabler--x] size-4"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body" id="editFormContainer">
                </div>
            </div>
        </div>
    </div>
</div>
