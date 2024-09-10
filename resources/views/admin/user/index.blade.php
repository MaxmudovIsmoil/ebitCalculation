@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="bg-shadow position-relative">
            <button data-url="{{ route('admin.user.store') }}" class="btn btn-primary btn-sm add-btn float-left js_add_btn">
                <i class="fa-solid fa-user-plus"></i> &nbsp; Add
            </button>

            <table class="table table-bordered table-striped table-sm w-100 table-hover" id="userDatatable">
                <thead>
                    <tr>
                        <th class="text-center">№</th>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ldap</th>
                        <th class="text-center">Lang</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('admin.user.addEditModal')
    @include('layouts.deleteModal')

@endsection


@push('script')
    <script>
        var modal = $('#add_edit_modal');

        var userDatatable = $('#userDatatable').DataTable({
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
                url: '{{ route("admin.getUsers") }}',
                type: 'GET'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'position'},
                {data: 'name'},
                {data: 'email'},
                {data: 'username'},
                {data: 'status'},
                {data: 'ldap'},
                {data: 'language'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });


        $(document).on('click', '.js_add_btn', function () {
            let url = $(this).data('url')
            let form = modal.find('.js_add_edit_form')

            form.attr('action', url);
            user_form_clear(form);
            modal.find('.modal-title').html('Add user');
            modal.modal('show');
        });

        $(document).on('click', '.js_ldap', function() {
            let ldap = $(this).val();
            let passwordLdapDiv = $('.js_password_ldap_div');
            passwordLdapDiv.toggleClass('d-none', ldap === "1");
        });

        $(document).on('input', '.js_email', function() {
            let email = $(this).val();
            let atIndex = email.indexOf('@');
            if (atIndex !== -1) {
                let login = email.substring(0, atIndex);
                $('.js_username').val(login);
            }
        });

        $(document).on('click', '.js_edit_btn', function () {

            let one_url = $(this).data('one_url');
            let update_url = $(this).data('update_url');
            let form = modal.find('.js_add_edit_form');
            modal.find('.modal-title').html('Edit user');
            user_form_clear(form);

            form.attr('action', update_url);
            form.append('<input type="hidden" name="_method" value="PUT">');

            $.ajax({
                type: 'GET',
                url: one_url,
                dataType: 'JSON',
                success: (response) => {
                    // console.log(response)
                    const data = response.data;
                    const formFields = ['.js_position', '.js_name', '.js_email', '.js_phone', '.js_username'];

                    formFields.forEach(field => form.find(field).val(data[field.slice(4)]));

                    ['instanceId', 'status', 'language', 'canCreateOrder', 'showBuilder'].forEach(prop => {
                        const options = form.find(`.js_${prop} option`);
                        options.filter(`[value="${data[prop]}"]`).prop('selected', true);
                    });

                    modal.modal('show');
                },
                error: (response) => {
                    console.log('error: ', response)
                }
            })
        })


        $(document).on('submit', '.js_add_edit_form', function (e) {
            e.preventDefault()
            let form = $(this)
            let action = form.attr('action');

            $.ajax({
                url: action,
                type: "POST",
                dataType: "json",
                data: form.serialize(),
                success: (response) => {
                    // console.log('response: ', response);
                    if (response.success) {
                        modal.modal('hide');
                        userDatatable.draw();
                    }
                    else {
                        let errors = response.errors;
                        handleFieldError(form, errors, 'position');
                        handleFieldError(form, errors, 'name');
                        handleFieldError(form, errors, 'email');
                        handleFieldError(form, errors, 'username');
                        handleFieldError(form, errors, 'phone');
                        handleFieldError(form, errors, 'instanceId');
                    }
                }
            })
        });

        $(document).on('submit', '#js_modal_delete_form', function (e) {
            e.preventDefault();
            const deleteModal = $('#deleteModal');
            const $this = $(this);
            delete_function(deleteModal, $this, userDatatable);
        });



    </script>
@endpush
