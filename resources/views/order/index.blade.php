@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="bg-shadow">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    @if(\App\Helpers\Helper::canCreateOrderBtn())
                        <button data-url="{{ route('order.store') }}" class="btn btn-primary btn-sm js_add_btn mb-2 me-4">
                            <i class="fas fa-plus"></i> &nbsp; Create
                        </button>
                    @endif

                    <div class="form-check form-switch mt-1 ms-1">
                        <input class="form-check-input js_hide_show_tr_btn" @change="showActual" data-status="1" type="checkbox" role="switch" id="actuallyOrders">
                        <label class="form-check-label" for="actuallyOrders">@lang('text.Show only actual orders for me')</label>
                    </div>
                </div>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#orderAll">@lang("text.All")</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="accepted-tab" data-bs-toggle="tab" href="#orderProcessing">@lang("text.Processing")</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#orderCompleted">@lang("text.Completed")</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="declined-tab" data-bs-toggle="tab" href="#orderDeclined">@lang("text.Declined")</a>
                    </li>
                </ul>
            </div>
            <div class="content-body mt-1">
                <div class="tab-content">
                    <div class="tab-pane active" id="orderAll">
                        @include('order.orderAll')
                    </div>
                    <div class="tab-pane" id="orderProcessing">
                        @include('order.orderProcessing')
                    </div>
                    <div class="tab-pane" id="orderDeclined">
                        @include('order.orderDeclined')
                    </div>
                    <div class="tab-pane" id="orderCompleted">
                        @include('order.orderCompleted')
                    </div>
                </div>
            </div>
        </div>
        <!-- list section end -->
    </div>


    @include('order.addModal')

@endsection



@push('script')
    <script>
        function formClear(form) {
            form.find("input[type='text']").val('')
            form.remove('input[name="_method"]');
        }

        var modal = $('#addModal');

        $(document).on('click', '.js_add_btn', function() {
            let url = $(this).data('url');
            let form = modal.find('.js_add_edit_form');

            form.attr('action', url);
            formClear(form);
            modal.find('.modal-title').html('Add order');
            modal.modal('show');
        });


        /** User submit store or update **/
        $('.js_add_form').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            let action = form.attr('action');

            $.ajax({
                url: action,
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: (response) => {
                    console.log(response);
                    if (response.success) {
                        modal.modal('hide');
                        location.reload();
                    }
                },
                error: (response) => {
                    console.log('errors: ', response);
                    if (typeof response.responseJSON.errors !== 'undefined') {

                        let errors = response.responseJSON.errors;
                        handleFieldError(form, errors, 'date');
                        handleFieldError(form, errors, 'client');
                        handleFieldError(form, errors, 'address');
                        handleFieldError(form, errors, 'preliminaryCost');
                        handleFieldError(form, errors, 'contractPayment');
                        handleFieldError(form, errors, 'subscriptionFee');
                        handleFieldError(form, errors, 'monthlyPayment');
                        handleFieldError(form, errors, 'paybackPeriod');
                        handleFieldError(form, errors, 'constructionWork');
                    }

                }
            })
        });

        // $(document).on('submit', '#js_modal_delete_form', function (e) {
        //     e.preventDefault();
        //     const deleteModal = $('#deleteModal');
        //     const $this = $(this);
        //     delete_function(deleteModal, $this, datatable);
        // });
    </script>
@endpush
