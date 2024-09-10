@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @foreach ($roads as $roadMap)
                <div class="col-md-6 mb-4">
                    <div class="bg-shadow">
                        <div class="width-100 mb-4">
                            <b>Road map: {{ $roadMap['name']}}</b>
                            <button class="btn btn-primary float-end js_add_btn"
                                    data-road_id="{{ $roadMap['id'] }}"
                                    data-road_name="{{ $roadMap['name'] }}"
                                    data-url="{{ route('admin.road-map.store') }}"><i
                                    class="fa-solid fa-plus"></i> Add
                            </button>
                        </div>
                        <table class="table table-striped table-sm table-hover table-responsive" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Stage</th>
                                    <th>Instance</th>
                                    <th>Users</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($roadMap['roadMaps'] as $map)
                                <tr class="js_this_tr" data-id="{{ $map['id'] }}">
                                    <td align="center">{{ $map['stage'] }}</td>
                                    <td>{{ $map['name'] }}</td>
                                    <td>{{ $map['userNames'] }}</td>
                                    <td align="center">
                                        <div class="d-flex">
                                            <button class="btn btn-primary btn-sm me-2 js_edit_btn"
                                                    data-one_url="{{ route('admin.road-map.getOne', $map['id']) }}"
                                                    data-update_url="{{ route('admin.road-map.update', $map['id']) }}"
                                                    data-road_name="{{ $roadMap['name'] }}"
                                                    data-road_map_id="{{ $map['id'] }}" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm js_delete_btn"
                                                    href="javascript:void(0);"
                                                    data-toggle="modal" data-target="#deleteModal"
                                                    data-name="{{ $map['name'] }}"
                                                    data-url="{{ route('admin.road-map.destroy', $map['id']) }}"
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

    @include('admin.roadMap.addEditModal')


    @include('layouts.deleteModal')
@endsection


@push('script')
    <script>
        function formClear(form) {
            form.find("input[type='number']").val('');
            form.find(".js_roadId").val('');
            form.remove('input[name="_method"]');

            let instance = $('.js_instanceId option')
            $.each(instance, function (i, item) {
                $(item).prop('selected', false)
            });

            form.find('.js_user_ids').val([]);
            form.find('.js_user_ids').trigger('change');
        }


        var modal = $('#add_edit_modal');
        $('.js_user_ids').select2({
            width: '100%'
        });


        $(document).on('click', '.js_add_btn', function () {
            let roadId = $(this).data('road_id');
            let roadName = $(this).data('road_name');
            let url = $(this).data('url');
            let form = modal.find('.js_add_edit_form');

            formClear(form);
            form.attr('action', url);
            form.find('.js_roadId').val(roadId);
            modal.find('.modal-title').html(roadName);
            modal.modal('show');
        })


        $(document).on('click', '.js_edit_btn', function () {
            let one_url = $(this).data('one_url');
            let update_url = $(this).data('update_url');
            let form = modal.find('.js_add_edit_form');
            let roadMapId = $(this).data('road_map_id');
            let roadName = $(this).data('road_name');
            formClear(form);
            console.log(roadMapId);
            form.attr('action', update_url);
            form.find('.js_roadId').val(roadMapId);
            form.append('<input type="hidden" name="_method" value="PUT">');

            $.ajax({
                type: 'GET',
                url: one_url,
                dataType: 'JSON',
                success: (response) => {
                    console.log('response: ', response);
                    if (response.success) {
                        form.find('.js_stage').val(response.data.stage)

                        let instance = form.find('.js_instanceId option')
                        $.each(instance, function (i, item) {
                            if ($(item).val() == response.data.instanceId)
                                $(item).prop('selected', true);
                        });

                        form.find('.js_user_ids').val(response.data.userIds);
                        form.find('.js_user_ids').trigger('change');
                    }

                    modal.find('.modal-title').html(roadName);
                    modal.modal('show')
                },
                error: (response) => {
                    console.log('error: ', response)
                }
            });
        });


        /** order type instances users submit store or update **/
        $('.js_add_edit_form').on('submit', function (e) {
            e.preventDefault();
            let form = $(this);
            let action = form.attr('action');

            $.ajax({
                url: action,
                type: "POST",
                dataType: "json",
                data: form.serialize(),
                success: (response) => {
                    console.log('response: ', response);

                    if (response.success)
                        location.reload();

                    if (typeof response.errors !== 'undefined') {

                        if (response.errors.stage)
                            form.find('.js_stage').addClass('is-invalid');

                    }
                },
                error: (response) => {
                    console.log('error: ', response)
                }
            })
        });

        /* delete form submit */
        $(document).on('submit', '#js_modal_delete_form', function (e) {
            e.preventDefault();

            let url = $(this).attr('action');
            let this_tr = $(document).find('.js_this_tr');

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: (response) => {
                    console.log(response);
                    if(response.success)
                        location.reload();
                },
                error: (response) => {
                    console.log('error:', response);
                }
            });

        });
    </script>
@endpush
