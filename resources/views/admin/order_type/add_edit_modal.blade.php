<div class="modal fade text-left" id="add_edit_modal" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="dep">Add department</h4>
            </div>
            <form action="" method="POST" class="js_add_edit_form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Department<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control js_name" id="name" />
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="saveBtn">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
