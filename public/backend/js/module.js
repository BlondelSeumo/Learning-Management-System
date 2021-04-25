$(document).on('click', '.verifyBtn', function () {
    var module = $(this).data('id');
    $('#moduleName').val(module);
});
$(document).on('click', '.module_switch', function (e) {
    e.preventDefault();

    var url = $("#url").val();
    var module = $(this).data('id');
    console.log(module);

    $.ajax({
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $(".module_switch_label" + module).hide();
            $(".waiting_loader" + module).show();
        },
        url: url + "/modulemanager/" + "manage-adons-enable/" + module,
        success: function (data) {
            $(".waiting_loader" + module).hide();
            $(".module_switch_label" + module).show();
            if (data["success"]) {
                if (data["data"] == "enable") {
                    $(".module_switch_label" + module).text('Deactivate');
                    // $(`.${module}`).removeClass("bg-warning");
                    // $(`.${module}`).addClass("bg-success");
                    // $(`.${module}`).text("Enable");
                } else {
                    $(".module_switch_label" + module).text('Activate');

                    // $(`.${module}`).removeClass("bg-success");
                    // $(`.${module}`).addClass("bg-warning");
                    // $(`.${module}`).text("Disable");
                }
                toastr.success(data["success"], "Success Alert");
            } else {
                toastr.error(data["error"], "Fail Alert");
            }
            setTimeout(function () {
                window.location.reload(1);
            }, 1000);
        },
        error: function (data) {
            console.log("Error:", data["error"]);
            setTimeout(function () {
                window.location.reload(1);
            }, 500);
        },
    })
})
