@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="bg-shadow">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <button data-url="{{ route('order.store') }}" class="btn btn-primary btn-sm js_add_btn mb-2 me-4">
                        <i class="fas fa-plus"></i> &nbsp; Create
                    </button>

                    <div class="form-check form-switch mt-1 ms-1">
                        <input class="form-check-input js_hide_show_tr_btn" @change="showActual" data-status="1" type="checkbox" role="switch" id="actuallyOrders">
                        <label class="form-check-label" for="actuallyOrders">@lang('actual')</label>
                    </div>
                </div>

                <div class="btn-group mb-2" role="group" aria-label="Basic example">
                    <button class="btn btn-primary btn-sm">All</button>
                    <button class="btn btn-outline-primary btn-sm">Under consideration</button>
                    <button class="btn btn-outline-primary btn-sm">Refused</button>
                    <button class="btn btn-outline-primary btn-sm">Complated</button>
                </div>
            </div>
            <table id="order_datatable" class="table table-bordered table-fs-sm table-striped table-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>№</th>
                    <th>@lang('Road')</th>
                    <th>@lang('Instnace')</th>
                    <th>@lang('Creator')</th>
                    <th>@lang('CurrentInstance')</th>
                    <th>@lang('status')</th>
                    <th>@lang('stage')</th>
                    <th>@lang('Comment')</th>
                    <th class="text-right">@lang('CreatedAt')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="fw-semibold">
                        <td class="align-middle">
                            <p class="text-center mb-0">
                                {{ $order->orderId }} <br/>
                                <a class="a-eye" href="{{ route('orderDetail', $order->orderId) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </p>
                        </td>
                        <td class="align-middle">{{ $order->roadName }}</td>
                        <td class="align-middle">{{ $order->instanceName }}</td>
                        <td class="align-middle">{{ $order->userName }}</td>
                        <td class="align-middle">{{ $order->currentInstanceName }}</td>
                        <td class="align-middle">{{ $order->status }}</td>
                        <td class="align-middle text-center">{{ $order->allStage }} / {{ $order->currentStage }}</td>
                        <td class="align-middle">{{ $order->comment }}</td>
                        <td class="align-middle">{{ date('d.m.Y H:i:s', strtotime($order->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- list section end -->
    </div>


    @include('order.addModal')

    @include('layouts.deleteModal')

@endsection



@push('script')
    <script>
        function user_form_clear(form) {
            form.find("input[type='text']").val('')
            form.remove('input[name="_method"]');
        }

        var modal = $('#addModal');

        $(document).on('click', '.js_add_btn', function() {
            let url = $(this).data('url');
            let form = modal.find('.js_add_edit_form');

            form.attr('action', url);
            user_form_clear(form);
            modal.find('.modal-title').html('Add Instance');
            modal.modal('show');
        })


        $(document).on('click', '.js_edit_btn', function () {

            let one_url = $(this).data('one_url');
            let update_url = $(this).data('update_url');
            let form = modal.find('.js_add_edit_form');
            modal.find('.modal-title').html('Edit Instance');
            user_form_clear(form);

            form.attr('action', update_url);
            form.append('<input type="hidden" name="_method" value="PUT">');

            $.ajax({
                type: 'GET',
                url: one_url,
                dataType: 'JSON',
                success: (response) => {
                    console.log(response)
                    const data = response.data;
                    const formFields = ['.js_name', '.js_timeLine'];
                    formFields.forEach(field => form.find(field).val(data[field.slice(4)]));
                    modal.modal('show');
                },
                error: (response) => {
                    console.log('error: ', response)
                }
            })
        })


        /** User submit store or update **/
        $('.js_add_edit_form').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            let action = form.attr('action');

            $.ajax({
                url: action,
                type: "POST",
                dataType: "JSON",
                data: form.serialize(),
                success: (response) => {
                    console.log(response);
                    if (response.success) {
                        modal.modal('hide');
                        datatable.draw();
                    }
                },
                error: (response) => {
                    console.log('errors: ', response);
                    if (typeof response.responseJSON.errors !== 'undefined') {
                        if (response.responseJSON.errors.name)
                            form.find('.js_name').addClass('is-invalid')
                    }

                }
            })
        });

        $(document).on('submit', '#js_modal_delete_form', function (e) {
            e.preventDefault();
            const deleteModal = $('#deleteModal');
            const $this = $(this);
            delete_function(deleteModal, $this, datatable);
        });
    </script>
@endpush
