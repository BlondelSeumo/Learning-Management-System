
$("#checkbox").click(function () {
    if ($("#checkbox").is(':checked')) {
        $("#selectStaffss > option").prop("selected", "selected");
        $("#selectStaffss").trigger("change");
    } else {
        $("#selectStaffss > option").removeAttr("selected");
        $("#selectStaffss").trigger("change");
    }
});

$("#checkbox_section").click(function () {
    if ($("#checkbox_section").is(':checked')) {
        $("#selectSectionss > option").prop("selected", "selected");
        $("#selectSectionss").trigger("change");
    } else {
        $("#selectSectionss > option").removeAttr("selected");
        $("#selectSectionss").trigger("change");
    }
});
$('.close_modal').on('click', function() {
    $('.custom_notification').removeClass('open_notification');
});
$('.notification_icon').on('click', function() {
    $('.custom_notification').addClass('open_notification');
});
$(document).click(function(event) {
    if (!$(event.target).closest(".custom_notification").length) {
        $("body").find(".custom_notification").removeClass("open_notification");
    }
});
$(document).ready(function () {
    $('#languageChange').on('change', function () {
        var str = $('#languageChange').val();
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        // get section for student
        $.ajax({
            type: "POST",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'language-change',
            success: function (data) {
                url= url + '/' + 'locale'+ '/' + data[0].language_universal;
                window.location.href = url;
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
