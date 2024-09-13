<div class="modal fade bg-dark bg-opacity-50" id="confirmModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="confirmModalLabel"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptLabel">@lang('text.Reply')</h5>
            </div>
            <form action="{{ route('order.action', [$order['id']]) }}" method="POST" class="jsOrderActionForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" class="js_status" value="2">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">@lang('text.Reply'):</label>
                        <b class="js_text"></b>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">@lang('text.Comment'):</label>
                        <textarea class="form-control js_comment" name="comment" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('text.Apply')</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('text.Close')</button>
                </div>
            </form>
        </div>
    </div>
</div>
