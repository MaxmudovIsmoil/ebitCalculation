<div class="modal fade" id="addOrderModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pt-2 pb-2">
                <h5 class="modal-title" id="addLabel"> @lang('addOrder')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-2 pb-2">
                    <div class="mb-3">
                        <label for="customer" class="form-label"> @lang('client')</label>
                        <input type="text" id="customer" class="form-control" name="customer" />
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="address" class="form-label"> @lang('address')</label>
                            <input type="text" id="address" class="form-control" name="address" />
                        </div>
                        <div class="col-md-6">
                            <label for="equipment_cost" class="form-label"> @lang('equipment_and_material_costs')</label>
                            <input type="text" id="equipment_cost" class="form-control" name="equipment_cost" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="work_materials" class="form-label"> @lang('labor_and_materials')</label>
                            <input type="text" id="work_materials" class="form-control" name="work_materials" />
                        </div>
                        <div class="col-md-6">
                            <label for="lcs" class="form-label"> @lang('lcs')</label>
                            <input type="text" id="lcs" class="form-control" name="lcs" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="subscription_fee" class="form-label"> @lang('subscriber_line_organization_fee')</label>
                            <input type="text" id="subscription_fee" class="form-control" name="subscription_fee" />
                        </div>
                        <div class="col-md-6">
                            <label for="monthly_payment" class="form-label"> @lang('monthly_payment')</label>
                            <input type="text" id="monthly_payment" class="form-control" name="monthly_payment" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="payback_period" class="form-label"> @lang('payback_period')</label>
                            <input type="text" id="payback_period" class="form-control" name="payback_period" />
                        </div>
                        <div class="col-md-6">
                            <label for="basis" class="form-label"> @lang('basis')</label>
                            <input type="text" id="basis" class="form-control" name="basis" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label"> @lang('attached_files')</label>
                        <input type="file" id="file" class="form-control" name="files[]" multiple />
                    </div>
                </div>
                <div class="modal-footer pt-2 pb-2">
                    <input type="submit" class="btn btn-primary" :value="$t('apply')">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> @lang('close')</button>
                </div>
            </form>
        </div>
    </div>
</div>
