<div class="modal fade text-left" id="add_edit_modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add Instance</h4>
            </div>
            <form action="" method="POST" class="js_add_edit_form">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-8 form-group">
                            <label for="name">Instance<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control js_name" aria-label="name" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="timeLine">Time line<span class="text-danger">*</span></label>
                            <input type="number" name="timeLine" class="form-control js_timeLine" id="timeLine" />
                            <div class="invalid-feedback"></div>
                        </div>
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
