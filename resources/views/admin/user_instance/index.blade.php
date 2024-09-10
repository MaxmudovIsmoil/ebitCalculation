@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @foreach ($order_types as $order_type)
                <div class="col-md-6 mb-4">
                    <div class="bg-shadow">
                        <div class="width-100 mb-4">
                            <b>{{ __('Тип заказа') }}: @if($lang == 'ru') {{$order_type->name_ru}} @else {{$order_type->name_en}} @endif</b>
                            <button class="btn btn-primary float-end js_add_btn"
                                data-order_type_id="{{ $order_type->id }}"
                                data-order_type_name="@if($lang == 'ru') {{$order_type->name_ru}} @else {{$order_type->name_en}} @endif"
                                data-url="{{ route('user-instance.store') }}"><i
                                class="fa-solid fa-plus"></i>  {{ __('Добавить') }}</button>
                        </div>
                        <table class="table table-striped table-sm table-hover table-responsive" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('Стадия') }}</th>
                                    <th>{{ __('Инстанция') }}</th>
                                    <th>{{ __('Пользователи (в инстанции)') }}</th>
                                    <th>{{ __('Действия') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($order_type->order_type_instances as $order_type_instance)
                                    <tr class="js_this_tr" data-id="{{ $order_type_instance->id }}">
                                        <td align="center">{{ $order_type_instance->stage }}</td>
                                        <td>
                                            @if($lang == 'ru')
                                                {{ $order_type_instance->instance->name_ru }}
                                            @else
                                                {{ $order_type_instance->instance->name_en }}
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($order_type_instance->instance->users as $user)
                                                {{ $user->user->full_name.',' }}
                                            @endforeach
                                        </td>
                                        <td align="center">
                                            <div class="d-flex">
                                                <button class="btn btn-primary btn-sm me-2 js_edit_btn"
                                                    data-one_diu_url="{{ route('user-instance.getOne', $order_type_instance->id) }}"
                                                    data-update_url="{{ route('user-instance.update', $order_type_instance->id) }}"
                                                    data-order_type_name="@if($lang == 'ru') {{ $order_type->name_ru }} @else {{ $order_type->name_en }} @endif"
                                                    data-order_type_id="{{ $order_type->id }}" title="Edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm js_delete_btn" href="javascript:void(0);"
                                                    data-toggle="modal" data-target="#deleteModal"
                                                    data-name="@if($lang == 'ru') {{ $order_type_instance->instance->name_ru }} @else {{ $order_type_instance->instance->name_en }} @endif"
                                                    data-url="{{ route('user-instance.destroy', $order_type_instance->id) }}"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach


        </div>
    </div>

    @include('admin.user_instance.add_edit_modal')


    @include('layouts.deleteModal')
@endsection


@section('script')
    <script>
        function user_form_clear(form) {
            form.find("input[type='number']").val('')
            form.find(".js_order_type_id").val('')
            form.remove('input[name="_method"]');

            let instance = $('.js_instance option')
            $.each(instance, function(i, item) {
                $(item).prop('selected', false)
            });

            form.find('.js_user_ids').val([]);
            form.find('.js_user_ids').trigger('change');
        }


        var modal = $('#add_edit_modal');
        $('.js_user_ids').select2({
            width: '100%'
        });



        $(document).on('click', '.js_add_btn', function() {
            let order_type_id = $(this).data('order_type_id')
            let order_type_name = $(this).data('order_type_name')
            let url = $(this).data('url')
            let form = modal.find('.js_add_edit_form')

            user_form_clear(form)
            form.attr('action', url)
            form.find('.js_order_type_id').val(order_type_id);
            modal.find('.modal-title').html(order_type_name);
            modal.modal('show')
        })



        $(document).on('click', '.js_edit_btn', function() {
            let one_url = $(this).data('one_diu_url')
            let update_url = $(this).data('update_url')
            let form = modal.find('.js_add_edit_form')
            let order_type_id = $(this).data('order_type_id')
            let order_type_name = $(this).data('order_type_name')
            user_form_clear(form);

            form.attr('action', update_url);
            form.find('.js_order_type_id').val(order_type_id);
            form.append('<input type="hidden" name="_method" value="PUT">');

            $.ajax({
                type: 'GET',
                url: one_url,
                dataType: 'JSON',
                success: (response) => {
                    // console.log('response: ', response);
                    if (response.status) {
                        form.find('.js_stage').val(response.data.stage)

                        let instance = form.find('.js_instance option')
                        $.each(instance, function(i, item) {
                            if ($(item).val() == response.data.instance_id)
                                $(item).prop('selected', true)
                        })

                        const users = [];
                        $.each(response.data.instance.users, function(i, item) {
                            users[i] = item.user_id;
                        });
                        form.find('.js_user_ids').val(users)
                        form.find('.js_user_ids').trigger('change')
                    }

                    modal.find('.modal-title').html(order_type_name)
                    modal.modal('show')
                },
                error: (response) => {
                    console.log('error: ', response)
                }
            });
        });



        /** order type instances users submit store or update **/
        $('.js_add_edit_form').on('submit', function(e) {
            e.preventDefault()
            let form = $(this)
            let action = form.attr('action')

            let stage = form.find('.js_stage')
            let instnace_id = form.find('.instance_id')
            let user_ids = form.find('.user_ids')

            $.ajax({
                url: action,
                type: "POST",
                dataType: "json",
                data: form.serialize(),
                success: (response) => {
                    console.log('response: ', response);

                    if (response.status)
                        location.reload()

                    if (typeof response.errors !== 'undefined') {

                        if (response.errors.stage)
                            form.find('.js_stage').addClass('is-invalid')

                    }
                },
                error: (response) => {
                    console.log('error: ', response)
                }
            })
        });
    </script>
@endsection
