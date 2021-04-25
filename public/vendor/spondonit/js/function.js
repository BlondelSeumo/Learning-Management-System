function ajax_error(data) {
    if (data.status === 404) {
        toastr.error("What you are looking is not found", 'Opps!');
        return;
    } else if (data.status === 500) {
        toastr.error('Something went wrong. If you are seeing this message multiple times, please contact Spondon It author.', 'Opps');
        return;
    } else if (data.status === 200) {
        toastr.error('Something is not right', 'Error');
        return;
    }
    let jsonValue = $.parseJSON(data.responseText);
    let errors = jsonValue.errors;
    if (errors) {
        let i = 0;
        $.each(errors, function(key, value) {
            let first_item = Object.keys(errors)[i];
            let error_el_id = $('#' + first_item);
            if (error_el_id.length > 0) {
                error_el_id.parsley().addError('ajax', {
                    message: value,
                    updateClass: true
                });
            }
            // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
            toastr.error(value, 'Validation Error');
            i++;
        });
    } else {
        toastr.error(jsonValue.message, 'Opps!');
    }
}

function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function _formValidation(form_id = 'content_form', modal = false, modal_id = 'content_modal', ajax_table = null) {

    const form = $('#' + form_id);

    if (!form.length) {
        return;
    }

    form.parsley().on('field:validated', function() {
        $('.parsley-ajax').remove();
        const ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    form.on('submit', function(e) {
        e.preventDefault();
        $('.parsley-ajax').remove();
        $('.preloader').fadeIn();
        form.find('.submit').hide();
        form.find('.submitting').show();
        const submit_url = form.attr('action');
        const method = form.attr('method');
        //Start Ajax
        const formData = new FormData(form[0]);
        $.ajax({
            url: submit_url,
            type: method,
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                form.find('input:text').val('');
                form.find("input:text:visible:first").focus();
                toastr.success(data.message, 'Succes');
                // if (modal) {
                //     $("." + modal_id).modal('hide');
                // }
                if (ajax_table) {
                    ajax_table.ajax.reload();
                }

                if (data.goto) {
                    window.location.href = data.goto;
                }

                if (data.reload) {
                    window.location.href = '';
                }

                form.find('.submit').show();
                form.find('.submitting').hide();
                $('.preloader').fadeOut();

            },
            error: function(data) {
                ajax_error(data);
                form.find('.submit').show();
                form.find('.submitting').hide();
                $('.preloader').fadeOut();
            }
        });
    });
}