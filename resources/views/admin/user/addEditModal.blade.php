<div class="modal fade text-left" id="add_edit_modal" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
            </div>
            <form action="" method="POST" class="js_add_edit_form">
                @csrf
                <input type="hidden" name="oldInstanceId" class="js_old_instance_id" value="" />
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="road" class="form-label">Department (order-type)<span class="text-danger">*</span></label>
                            <select name="roadId" class="form-select js_road_id" aria-label="road">
                                <option value="">---</option>
                                @foreach ($roads as $road)
                                    <option value="{{ $road['id'] }}">{{ $road['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="instance" class="form-label">Instance <span class="text-danger">*</span></label>
                            <select name="instanceId" class="form-select js_instanceId" aria-label="instance">
                                <option value="">---</option>
                                @foreach ($instances as $instance)
                                    <option value="{{ $instance['id'] }}">{{ $instance['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                            <input type="text" name="position" class="form-control js_position" id="position" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="full_name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control js_name" id="fname" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control js_phone" aria-label="phone" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control js_email" id="email" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="username">Login <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control js_username" id="username" />
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="language">language</label>
                            <select name="language" aria-label="language" class="form-select js_language">
                                <option value="en">English</option>
                                <option value="ru">Russian</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="status">Status </label>
                            <select name="status" id="status" class="form-select js_status">
                                <option value="1">Active</option>
                                <option value="0">No active</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="canCreateOrder">Can create order</label>
                            <select name="canCreateOrder" aria-label="canCreateOrder"
                                class="form-select js_canCreateOrder">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="showBuilder">Show Bulider</label>
                            <select name="showBuilder" aria-label="showBuilder" class="form-select js_showBuilder">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
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
