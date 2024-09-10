@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="bg-shadow">
            <button data-url="{{ route('admin.instance.store') }}" class="btn btn-primary float-left js_add_btn">
                <i class="fas fa-plus"></i> &nbsp; Add Instance
            </button>
            <table class="table table-sm table-bordered table-striped table-hover" id="datatable">
                <thead>
                    <tr>
                        <th class="text-center" width="3%">№</th>
                        <th>Name</th>
                        <th>Time Line</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <!-- list section end -->
    </div>


    @include('admin.instance.addEditModal')

    @include('layouts.deleteModal')

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

        $('#datatable').DataTable({
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
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.getInstnaces") }}',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'timeLine'},
                {data: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $(document).on('click', '.js_add_btn', function() {
            let url = $(this).data('url')
            let form = modal.find('.js_add_edit_form')

            form.attr('action', url)
            user_form_clear(form)
            modal.find('.modal-title').html('Add Instance');
            modal.modal('show')
        })


        $(document).on('click', '.js_edit_btn', function() {

            let one_url = $(this).data('one_instance_url');
            let update_url = $(this).data('update_url');
            let form = modal.find('.js_add_edit_form')
            user_form_clear(form)

            form.attr('action', update_url)
            form.append('<input type="hidden" name="_method" value="PUT">')
            $.ajax({
                type: 'GET',
                url: one_url,
                dataType: 'JSON',
                success: (response) => {
                    console.log(response)
                    if (response.status) {
                        form.find('.js_name').val(response.data.name);
                        form.find('.js_timeLine').val(response.data.timeLine);
                    }
                    modal.find('.modal-title').html('Edit Instance')
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
                    console.log(response)
                    if (response.status)
                        location.reload()
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
    </script>
@endsection
