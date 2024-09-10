@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="bg-shadow">
            <button data-url="{{ route('admin.road.store') }}" class="btn btn-primary float-left js_add_btn">
                <i class="fas fa-plus"></i> &nbsp; Add
            </button>
            <table class="table table-sm table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
                        <th class="text-center" width="3%">№</th>
                        <th>Name</th>
{{--                        <th>Status</th>--}}
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- list section end -->
    </div>


    @include('admin.road.addEditModal')

    @include('layouts.deleteModal')

@endsection



@push('script')
    <script>
        function user_form_clear(form) {
            form.find("input[type='text']").val('')
            form.remove('input[name="_method"]');
        }

        var modal = $('#add_edit_modal');

        var datatable = $('#datatable').DataTable({
            scrollY: '60vh',
            scrollCollapse: true,
            paging: true,
            pageLength: 100,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            language: {
                search: "",
                searchPlaceholder: "Search",
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.getRoads") }}',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'name'},
                // {data: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $(document).on('click', '.js_add_btn', function() {
            let url = $(this).data('url');
            let form = modal.find('.js_add_edit_form');

            form.attr('action', url);
            user_form_clear(form);
            modal.find('.modal-title').html('Add Road');
            modal.modal('show');
        })


        $(document).on('click', '.js_edit_btn', function () {

            let one_url = $(this).data('one_url');
            let update_url = $(this).data('update_url');
            let form = modal.find('.js_add_edit_form');
            modal.find('.modal-title').html('Edit Road');
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
                    const formFields = ['.js_name'];
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
