(function ($) {
    "use strict";
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
            },
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

    // status_enable_disable

    $("#lms_table").on("change", ".status_enable_disable", function () {

        let demoMode = $('#demoMode').val();
        if (demoMode == 1) {
            toastr.warning("For the demo version, you cannot change this", "Warning");
            return false;
        }


        let status = 0;
        if ($(this).is(':checked')) {
            status = 1;
        } else {
            status = 0;
        }

        let id = $(this).val();
        let url = $("#url").val();
        let table = $("#table_name").val();


        let formData = {
            id: id,
            table: table,
            status: status,
        };
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "status-enable-disable",
            success: function (data) {
                if (data.warning) {
                    toastr.warning(data.warning, 'Error');
                } else if (data.success) {
                    toastr.success(data.success, 'Success');
                } else if (data.error) {
                    toastr.error(data.error, 'Error');
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON);
                toastr.error('Something went wrong!', 'Falied');
            },
        });

    });


    // status_enable_disable
    $("#lms_table").on("change", ".publish_enable_disable", function () {
        var status = 0;
        if ($(this).is(':checked')) {
            status = 1;
        } else {
            status = 0;
        }

        var id = $(this).val();
        var url = $("#url").val();
        var table = $("#table_name").val();


        var formData = {
            id: id,
            table: table,
            status: status,
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "publish-enable-disable",
            success: function (data) {
                toastr.success('Publish status has been changed', 'Success');
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON);
                toastr.error('Something went wrong !', 'Falied');
            },
        });

    });

    $(".topbar_enable_disable").on("change", function () {
        var status = 0;
        if ($(this).is(':checked')) {
            var status = 1;
        } else {
            var status = 0;
        }
        alert('topbar_enable_disable');

        var id = $(this).val();
        var url = $("#url").val();
        var table = $("#table_name").val();


        var formData = {
            id: id,
            table: table,
            status: status,
        };
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "topbar-enable-disable",
            success: function (data) {
                toastr.success('Status has been changed', 'Success');
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON);
                toastr.error('Something went wrong !', 'Falied');
            },
        });

    });


    $(".footer_enable_disable").on("change", function () {
        var status = 0;
        if ($(this).is(':checked')) {
            var status = 1;
        } else {
            var status = 0;
        }
        alert('footer_enable_disable');

        var id = $(this).val();
        var url = $("#url").val();
        var table = $("#table_name").val();


        var formData = {
            id: id,
            table: table,
            status: status,
        };
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "footer-enable-disable",
            success: function (data) {
                toastr.success('Status has been changed', 'Success');
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseJSON);
                toastr.error('Something went wrong !', 'Falied');
            },
        });

    });


    $(".browseImg").change(function (e) {
        e.preventDefault();
        console.log('Browse image')
        var file = $(this).closest('.primary_file_uploader').find('.imgName');
        var filename = $(this).val().split('\\').pop();
        file.val(filename);
    });

    $(".toggle-password, .toggle-password2, .toggle-password3").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });


    $("body").on('change', '.fileUpload', function () {
        let placeholder = $(this).closest(".primary_file_uploader").find(".filePlaceholder");
        let fileInput = event.srcElement;
        placeholder.val(fileInput.files[0].name);
        console.log(fileInput.files[0].name);

    });




    makeItemChecked($("#pagess"), $("#pagesCheckbox"));
    makeItemChecked($("#staticPagesInput"), $("#staticPagesCheckbox"));
    makeItemChecked($("#categoryInput"), $("#categoryCheckbox"));
    makeItemChecked($("#subCategoryInput"), $("#subCategoryCheckbox"));
    makeItemChecked($("#courseInput"), $("#coursesCheckbox"));
    makeItemChecked($("#quizInput"), $("#quizCheckbox"));
    makeItemChecked($("#classInput"), $("#classCheckbox"));



    function makeItemChecked(item, itemCheckbox) {
        item.on("select2:opening select2:closing", function (event) {
            var $searchfield = $(this).parent().find(".select2-search__field");
            $searchfield.prop("disabled", true);
        });

        item.select2();

        $(document).ready(function () {
            itemCheckbox.click(function () {
                if (itemCheckbox.is(":checked")) {
                    //select all
                    item.find("option").prop("selected", true);
                    item.trigger("change");
                } else {
                    //deselect all
                    item.find("option").prop("selected", false);
                    item.trigger("change");
                }
            });
        });
    }


}(jQuery));
