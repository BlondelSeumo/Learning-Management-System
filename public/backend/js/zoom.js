$(document).ready(function () {
    $(document).on('change', '.user_type', function () {
        let userType = $(this).val();
        let url = $('.get_user').val();
        // $("#selectSectionss").select2().empty()
        $.post(url, {user_type: userType}, function (res) {
            // $("#selectSectionss").select2().empty()
            $.each(res, function (index, item) {
                $('#selectSectionss').append(new Option(item.name, item.id))
            });
        })
    })

    $(document).on('click', '.recurring-type', function () {
        if ($("input[name='is_recurring']:checked").val() == 0) {
            $(".recurrence-section-hide").hide();
        } else {
            $(".recurrence-section-hide").show();
        }
    })

    $(document).on('click', '.chnage-default-settings', function () {
        if ($(this).val() == 0) {
            $(".default-settings").hide();
        } else {
            $(".default-settings").show();
        }
    })
    let is_default_settings = $('.is_default_settings').val();
    if(is_default_settings && is_default_settings == 1)
        $(".default-settings").show();
    else
        $(".default-settings").hide();

    let is_recurring = $('.recurrence_section').val();
    if ( is_recurring == 1)
        $(".recurrence-section-hide").show()
    else
        $(".recurrence-section-hide").hide();
})
