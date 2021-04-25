let token = $('.csrf_token').val();
$(document).ready(function () {
    $('#add_laguage_modal').hide();
    $('#file_name').trigger("change");
});

function open_add_laguage_modal(el) {
    $('#add_laguage_modal').modal('show');
    $('#language_add').modal('show');
}

function edit_language_modal(el) {
    let url = $('.edit_lang').val();
    $.post(url, {_token: token, id: el}, function (data) {
        $('#edit_form').html(data);
        $('#Item_Edit').modal('show');
    });
}

function update_rtl_status(el) {
    let url = $('.rtl_status').val();
    let demoMode = $('#demoMode').val();

    if (el.checked) {
        var status = 1;
    } else {
        var status = 0;
    }
    $.post(url, {
        _token: token,
        id: el.value,
        status: status
    }, function (data) {
        if (data == 1) {
            toastr.success(
                "Operation Done Successfully",
                "Success", {
                    timeOut: 5000,
                }
            );
        } else {
            toastr.warning(
                "Something went wrong",
                "Warning", {
                    timeOut: 5000,
                }
            );
        }
    });
}

function update_active_status(el) {
    let url = $('.active_status').val();

    let demoMode = $('#demoMode').val();
    if (demoMode == 1) {
        toastr.warning("For the demo version, you cannot change this", "Warning");
        return false;
    }

    if (el.checked) {
        var status = 1;
    } else {
        var status = 0;
    }
    $.post(url, {
        _token: token,
        id: el.value,
        status: status
    }, function (data) {
        if (data == 1) {
            toastr.success(
                "Operation Done Successfully",
                "Success", {
                    timeOut: 5000,
                }
            );
        } else {
            toastr.warning(
                "Something went wrong",
                "Warning", {
                    timeOut: 5000,
                }
            );
        }
        location.reload();
    });
}

