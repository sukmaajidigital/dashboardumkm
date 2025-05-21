<button type="button" class="btn btn-success" aria-haspopup="dialog" aria-expanded="false" aria-controls="form-modal-{{ $id }}" data-overlay="#form-modal-{{ $id }}"> <span class="icon-[tabler--printer] mr-1"></span> Cetak QR</button>
<div id="form-modal-{{ $id }}" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 hidden" role="dialog" tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100 overlay-open:duration-300">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Total Cetak</h3>
                <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close" data-overlay="#form-modal-{{ $id }}"><span class="icon-[tabler--x] size-4"></span></button>
            </div>
            <form action="{{ $route }}" method="POST" target="_blank">
                @csrf
                @method('POST')
                <div class="modal-body pt-0">
                    <div class="mb-4">
                        <label class="label-text" for="total"> Total Cetak </label>
                        <input type="number" placeholder="berapapun" name="total" class="input" id="total" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft btn-secondary" data-overlay="#form-modal-{{ $id }}">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
