@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="bg-shadow">
            <button data-url="{{ route('order-type.store') }}" class="btn btn-primary float-left js_add_btn">
                <i class="fas fa-plus"></i> &nbsp; {{__("Добавить инстанция")}}
            </button>
            <table class="table table-sm table-bordered table-striped table-hover" id="order_type_datatable">
                <thead>
                    <tr>
                        <th class="text-center" width="3%">№</th>
                        <th>{{ __('Тип заказа') }} En</th>
                        <th>{{ __('Тип заказа') }} Ru</th>
                        <th class="text-end">{{ __('Действия') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($order_types as $order_type)
                        <tr class="js_this_tr" data-id="{{ $order_type['id'] }}">
                            <td class="text-center">{{ 1 + $loop->index }}</td>
                            <td>
                                {{ $order_type['name_en'] }}
                            </td>
                            <td>
                               {{ $order_type['name_ru'] }}
                            </td>
                            <td class="text-end">
                                <div style="float: right;">
                                    <a class="btn btn-primary btn-sm js_edit_btn"
                                        data-one_order_type_url="{{ route('order-type.getOne', $order_type['id']) }}"
                                        data-update_url="{{ route('order-type.update', $order_type['id']) }}" title="Edit">
                                        <i class="fas fa-pen mr-50"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- list section end -->
    </div>


    @include('admin.order_type.add_edit_modal')


@endsection


@section('script')
    <script>
        function user_form_clear(form) {
            form.find("input[type='text']").val('')
            form.remove('input[name="_method"]');

            let department = $('.js_department option')
            $.each(department, function(i, item) {
                $(item).prop('selected', false)
            });

        }

        var modal = $('#add_edit_modal')

        $('#order_type_datatable').DataTable({
            scrollY: '80vh',
            scrollCollapse: true,
            paging: true,
            pageLength: 50,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            language: {
                search: "",
                searchPlaceholder: "Search",
            }
        });

        $(document).on('click', '.js_add_btn', function() {
            let url = $(this).data('url')
            let form = modal.find('.js_add_edit_form')

            form.attr('action', url)
            user_form_clear(form)
            modal.find('.modal-title').html(' {{__("Добавить Тип заказа") }} ');
            modal.modal('show')
        })


        $(document).on('click', '.js_edit_btn', function() {

            let one_url = $(this).data('one_order_type_url')
            let update_url = $(this).data('update_url')
            let form = modal.find('.js_add_edit_form')
            user_form_clear(form)

            form.attr('action', update_url)
            form.append('<input type="hidden" name="_method" value="PUT">')
            $.ajax({
                type: 'GET',
                url: one_url,
                dataType: 'JSON',
                success: (response) => {
                    // console.log(response)
                    if (response.status) {
                        form.find('.js_name_ru').val(response.data.name_ru)
                        form.find('.js_name_en').val(response.data.name_en)

                    }
                    modal.find('.modal-title').html(' {{__("Изменить Тип заказа") }} ')
                    modal.modal('show')
                },
                error: (response) => {
                    console.log('error: ', response)
                }
            })
        })


        /** User submit store or update **/
        $('.js_add_edit_form').on('submit', function(e) {
            e.preventDefault()
            let form = $(this)
            let action = form.attr('action')

            $.ajax({
                url: action,
                type: "POST",
                dataType: "JSON",
                data: form.serialize(),
                success: (response) => {
                    // console.log(response)
                    if (response.status)
                        location.reload()
                },
                error: (response) => {
                    console.log('errors: ', response);
                    if (typeof response.responseJSON.errors !== 'undefined') {
                        if (response.responseJSON.errors.name_ru)
                            form.find('.js_name_ru').addClass('is-invalid')

                        if (response.responseJSON.errors.name_en)
                            form.find('.js_name_en').addClass('is-invalid')
                    }

                }
            })
        });
    </script>
@endsection
