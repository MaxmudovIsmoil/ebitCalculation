<div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header pt-2 pb-2">
                <h5 class="modal-title" id="addLabel"> @lang('Add Order')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('order.store') }}" method="POST" class="js_add_form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pt-2 pb-2">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="date" class="form-label"> @lang('Date')</label>
                            <input type="date" aria-label="date" class="form-control js_date" name="date" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="client" class="form-label"> @lang('Client')</label>
                            <input type="text" aria-label="client" class="form-control js_client" name="client" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="address" class="form-label"> @lang('Address')</label>
                            <input type="text" aria-label="address" class="form-control js_address" name="address" />
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="preliminaryCost" class="col-form-label">@lang('Preliminary cost'):</label>
                            <textarea class="form-control js_contractPayment" name="preliminaryCost" rows="4" aria-label="preliminaryCost"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="contractPayment" class="col-form-label">@lang('№ оf Contract, payment for the organization of the subscriber line,  monthly income for services'):</label>
                            <textarea class="form-control js_contractPayment" name="contractPayment" rows="4" aria-label="contractPayment"></textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="subscriptionFee" class="form-label"> @lang('Fee for organizing a subscriber line')</label>
                            <input type="text" aria-label="subscriptionFee" class="form-control js_subscriptionFee" name="subscriptionFee" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="monthlyPayment" class="form-label"> @lang('Monthly Payment')</label>
                            <input type="text" aria-label="monthlyPayment" class="form-control js_monthlyPayment" name="monthlyPayment" />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="paybackPeriod" class="form-label"> @lang('Payback period')</label>
                            <input type="text" aria-label="paybackPeriod" class="form-control js_paybackPeriod" name="paybackPeriod" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="constructionWork" class="form-label"> @lang('Construction work')</label>
                            <input type="text" aria-label="constructionWork" class="form-control js_constructionWork" name="constructionWork" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="comment" class="form-label"> @lang('Comment')</label>
                            <input type="text" aria-label="comment" class="form-control js_comment" name="comment" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="file" class="form-label"> @lang('Attached files')</label>
                            <input type="file" aria-label="file" class="form-control js_files" name="files[]" multiple/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pt-2 pb-2">
                    <input type="submit" class="btn btn-primary" value="@lang('Save')"/>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> @lang('close')</button>
                </div>
            </form>
        </div>
    </div>
</div>
