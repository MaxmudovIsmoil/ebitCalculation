<div class="modal fade text-left" id="add_edit_modal" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
            </div>
            <form action="" method="POST" class="js_add_edit_form">
                @csrf
                <input type="hidden" name="roadId" class="js_roadId" value="" />
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-2 form-group">
                            <label for="stage">Stage <span class="text-danger">*</span></label>
                            <input type="number" name="stage" class="form-control js_stage" aria-label="stage" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-10 form-group">
                            <label for="instance">Instance <span class="text-danger">*</span></label>
                            <select name="instanceId" class="form-control js_instanceId" aria-label="instance">
                                <option value="">---</option>
                                @foreach ($instances as $i)
                                    <option value="{{ $i['id'] }}">{{ $i['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="userIds">Users <span class="text-danger">*</span></label>
                            <select name="userIds[]" class="form-control js_user_ids" aria-label="userIds"
                                multiple="multiple">
                                <option value="">---</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>
                                @endforeach
                            </select>
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
