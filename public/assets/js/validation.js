function user_form_clear(form) {
    clearSelectOptions('.js_status');
    clearSelectOptions('.js_ldap');
    clearSelectOptions('.js_language');

    form.find("input[type='text'], input[type='email'], input[type='password']").val('');
    form.find('input[name="_method"]').remove();

    form.find('.js_password_ldap_div').removeClass('d-none');
}

function clearSelectOptions(selector) {
    let options = $(`${selector} option`);
    options.prop('selected', false);
}

function handleFieldError(form, errors, errorKey) {
    let element = form.find(`.js_${errorKey}`);
    if (errors[errorKey]) {
        element.addClass('is-invalid');
        element.siblings('.invalid-feedback').html(errors[errorKey][0]);
    }
}


function resetInputFields(form, inputType) {
    let input = form.find(`input[type="${inputType}"]`);

    if (input.length) {
        input.val('').removeClass('is-invalid').siblings('.invalid-feedback').addClass('valid-feedback');
    }
}

$(document).on('click', 'button[data-bs-dismiss="modal"]', function () {

    let form = $(this).closest('.modal').find('form');

    if (!form.hasClass('mainForm')) {
        resetInputFields(form, 'text');
    }
    resetInputFields(form, 'email');
    resetInputFields(form,'password');
})


$(document).on('input', 'input', function() {
    $(this).removeClass('is-invalid');
})

$(document).on('input', 'textarea', function() {
    $(this).removeClass('is-invalid');
})
