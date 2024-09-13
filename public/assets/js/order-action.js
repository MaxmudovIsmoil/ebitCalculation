/** btn ---> Agreed or Declined **/
$(document).on('click', '.js_reply_btn', function() {

    let modal = $('#confirmModal')
    let status = $(this).data('status');
    let text = $(this).data('text');

    let b_text = modal.find('.js_text');
    if (status == 1) {
        if (b_text.hasClass('text-danger'))
            b_text.removeClass('text-danger');

        b_text.addClass('text-success');
        b_text.html(text)

        modal.find('.js_status').val(status);
    } else {
        if (b_text.hasClass('text-success'))
            b_text.removeClass('text-success');

        b_text.addClass('text-danger');
        b_text.html(text)

        modal.find('.js_status').val(status);
    }

    modal.modal('show');
});


$(document).on('submit', '.jsOrderActionForm', function(e) {
    e.preventDefault();

    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: "POST",
        dataType: "JSON",
        data: form.serialize(),
        success: (response) => {
            // console.log(response);
            if (response.success)
                location.reload();
        },
        error: (response) => {
            console.log('error: ', response)
        }
    })

});
