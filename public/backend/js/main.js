(function ($) {
    'use strict';

    // metisMenu
    let metismenu = $("#sidebar_menu");
    if (metismenu.length) {
        metismenu.metisMenu();
    }

    $(".open_miniSide").click(function () {
        $(".sidebar").toggleClass("mini_sidebar");
        $("#main-content").toggleClass("mini_main_content");
    });

    function slideToggle(clickBtn, toggleDiv) {
        clickBtn.on('click', function () {
            toggleDiv.stop().slideToggle('slow');
        });
    }

    function removeDiv(clickBtn, toggleDiv) {
        clickBtn.on('click', function () {
            toggleDiv.hide('slow', function () {
                toggleDiv.remove();
            });
        });
    }

    slideToggle($('#barChartBtn'), $('#barChartDiv'));
    removeDiv($('#barChartBtnRemovetn'), $('#incomeExpenseDiv'));
    slideToggle($('#areaChartBtn'), $('#areaChartDiv'));
    removeDiv($('#areaChartBtnRemovetn'), $('#incomeExpenseSessionDiv'));

    /*-------------------------------------------------------------------------------
         Start Primary Button Ripple Effect
       -------------------------------------------------------------------------------*/
    $('.primary-btn').on('click', function (e) {
        // Remove any old one
        $('.ripple').remove();

        // Setup
        let primaryBtnPosX = $(this).offset().left,
            primaryBtnPosY = $(this).offset().top,
            primaryBtnWidth = $(this).width(),
            primaryBtnHeight = $(this).height();

        // Add the element
        $(this).prepend("<span class='ripple'></span>");

        // Make it round!


        // Get the center of the element
        let x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
        let y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

        // Add the ripples CSS and start the animation
        $('.ripple')
            .css({
                width: primaryBtnWidth,
                height: primaryBtnHeight,
                top: y + 'px',
                left: x + 'px'
            })
            .addClass('rippleEffect');
    });

    // for form popup
    $('.pop_up_form_hader').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.pop_up_form_hader.active').removeClass('active');
            $(this).addClass('active');
        }
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".company_form_popup").length) {
            $("body").find(".pop_up_form_hader").removeClass("active");
        }
    });
    jQuery(document).ready(function ($) {
        $('.small_circle_1').circleProgress({
            value: 0.75,
            size: 60,
            lineCap: 'round',
            emptyFill: '#F5F7FB',
            thickness: '5',
            fill: {
                gradient: [["#7C32FF", .47], ["#C738D8", .3]]
            }
        });
    });
    jQuery(document).ready(function ($) {
        $('.large_circle').circleProgress({
            value: 0.75,
            size: 228,
            lineCap: 'round',
            emptyFill: '#F5F7FB',
            thickness: '5',
            fill: {
                gradient: [["#7C32FF", .47], ["#C738D8", .3]]
            }
        });
    });

    jQuery(document).ready(function ($) {
        $(".entry-content").hide('slow');
        $(".entry-title").click(function () {
            $(".entry-content").hide();
            $(this).parent().children(".entry-content").slideToggle(600);
        });
    });

    $(document).ready(function () {
        // sumer note
        $('#summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 360,
            tooltip: true
        });
        // sumer note
        $('#summernote2').summernote({
            placeholder: '',
            tabsize: 2,
            height: 175,
            tooltip: true
        });
        // sumer note
        $('.summernote3').summernote({
            placeholder: '',
            tabsize: 2,
            height: 150,
            tooltip: true
        });
        // sumer note
        $('.summernote5').summernote({
            placeholder: 'Add your Comment',
            tabsize: 2,
            height: 120,
            tooltip: true
        });
        // sumer note
        $('.summernote4').summernote({
            placeholder: 'Hi {contact_firstname} {contact_lastname} New support ticket has been opened.Subject: {ticket_subject}Department: {ticket_department} Priority: {ticket_priority}Ticket message:{ticket_message}You can view the ticket on the following link: #{ticket_id}KindRegards,{email_signature}',
            tabsize: 2,
            height: 250,
            tooltip: true
        });

        $('.lms_summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 188,
            tooltip: true
        });

        $('.lms_summernote2').summernote({
            placeholder: '',
            tabsize: 2,
            height: 450,
            tooltip: true
        });
    })
    /*-------------------------------------------------------------------------------
         End Primary Button Ripple Effect
       -------------------------------------------------------------------------------*/


    /*-------------------------------------------------------------------------------
         Start Add Deductions
       -------------------------------------------------------------------------------*/
    $('#addDeductions').on('click', function () {
        $('#addDeductionsTableBody').append(
            '<tr>' +
            '<td width="80%" class="pr-30 pt-20">' +
            '<div class="input-effect mt-10">' +
            '<input class="primary-input form-control" type="text"  >' +
            '<label for="searchByFileName">Type</label>' +
            '<span class="focus-border"></span>' +
            '</div>' +
            '</td>' +
            '<td width="20%" class="pt-20">' +
            '<div class="input-effect mt-10">' +
            '<input class="primary-input form-control" type="text">' +
            '<label for="searchByFileName">Value</label>' +
            '<span class="focus-border"></span>' +
            '</div>' +
            '</td>' +
            '<td width="10%" class="pt-30">' +
            '<button class="primary-btn icon-only fix-gr-bg close-deductions">' +
            '<span class="ti-close"></span>' +
            '</button>' +
            '</td>' +
            '</tr>'
        );
    });

    $('#addDeductionsTableBody').on('click', '.close-deductions', function () {
        $(this).closest('tr').fadeOut(500, function () {
            $(this).closest('tr').remove();
        });
    });


    /*-------------------------------------------------------------------------------
         End Add Earnings
       -------------------------------------------------------------------------------*/

    /*-------------------------------------------------------------------------------
         Start Upload file and chane placeholder name
       -------------------------------------------------------------------------------*/
    let fileInput = document.getElementById('browseFile');
    if (fileInput) {
        fileInput.addEventListener('change', showFileName);

        function showFileName(event) {
            let fileInput = event.srcElement;
            let fileName = fileInput.files[0].name;
            document.getElementById('placeholderInput').placeholder = fileName;
        }
    }

    if ($('.multipleSelect').length) {
        $('.multipleSelect').fastselect();
    }

    /*-------------------------------------------------------------------------------
         End Upload file and chane placeholder name
       -------------------------------------------------------------------------------*/

    /*-------------------------------------------------------------------------------
         Start Check Input is empty
       -------------------------------------------------------------------------------*/
    $('.input-effect input').each(function () {
        if ($(this).val().length > 0) {
            $(this).addClass('read-only-input');
        } else {
            $(this).removeClass('read-only-input');
        }

        $(this).on('keyup', function () {
            if ($(this).val().length > 0) {
                $(this).siblings('.invalid-feedback').fadeOut('slow');
            } else {
                $(this).siblings('.invalid-feedback').fadeIn('slow');
            }
        });
    });

    $('.input-effect textarea').each(function () {
        if ($(this).val().length > 0) {
            $(this).addClass('read-only-input');
        } else {
            $(this).removeClass('read-only-input');
        }
    });

    /*-------------------------------------------------------------------------------
         End Check Input is empty
       -------------------------------------------------------------------------------*/
    $(window).on('load', function () {
        $('.input-effect input, .input-effect textarea').focusout(function () {
            if ($(this).val() != '') {
                $(this).addClass('has-content');
            } else {
                $(this).removeClass('has-content');
            }
        });
    });

    /*-------------------------------------------------------------------------------
         End Input Field Effect
       -------------------------------------------------------------------------------*/
    // Search icon
    $('#search-icon').on('click', function () {
        $('#search').focus();
    });

    $('#start-date-icon').on('click', function () {
        $('#startDate').focus();

    });

    $('#end-date-icon').on('click', function () {
        $('#endDate').focus();
    });
    $('.primary-input.date').datepicker({
        autoclose: true,
        setDate: new Date()
    });
    $('.primary-input.date').on('changeDate', function () {

        $(this).focus();
    });

    $('.primary-input.time').datetimepicker({
        format: 'LT'
    });

    $('#startDate').datepicker({
        Default: {
            leftArrow: '<i class="fa fa-long-arrow-left"></i>',
            rightArrow: '<i class="fa fa-long-arrow-right"></i>'
        }
    });
    /*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
       -------------------------------------------------------------------------------*/
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    $('#close_sidebar').on('click', function () {
        $('#sidebar').removeClass('active');
    })


    // setNavigation();
    /*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
       -------------------------------------------------------------------------------*/
    $(window).on('load', function () {

        $('.dataTables_wrapper .dataTables_filter input').on('focus', function () {
            $('.dataTables_filter > label').addClass('jquery-search-label');
        });

        $('.dataTables_wrapper .dataTables_filter input').on('blur', function () {
            $('.dataTables_filter > label').removeClass('jquery-search-label');
        });
    });


    $('.single-cms-box .btn').on('click', function () {
        $(this).fadeOut(500, function () {
            $(this).closest('.col-lg-2.mb-30').hide();
        });
    });

    /*----------------------------------------------------*/
    /*  Magnific Pop up js (Image Gallery)
    /*----------------------------------------------------*/
    $('.pop-up-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /*-------------------------------------------------------------------------------
         Jquery Table

    /*-------------------------------------------------------------------------------
         Nice Select
       -------------------------------------------------------------------------------*/
    if ($('.niceSelect').length) {
        $('.niceSelect').niceSelect();
    }
    //niceselect select jquery
    $('.nice_Select').niceSelect();
    //niceselect select jquery
    $('.nice_Select2').niceSelect();
    $('.primary_select').niceSelect();
    /*-------------------------------------------------------------------------------
       Full Calendar Js
    -------------------------------------------------------------------------------*/


    /*-------------------------------------------------------------------------------
       Moris Chart Js
    -------------------------------------------------------------------------------*/
    $(document).ready(function () {
        if ($('#commonAreaChart').length) {
            barChart();
        }
        if ($('#commonAreaChart').length) {
            areaChart();
        }
        if ($('#donutChart').length) {

            donutChart();
        }
    });


    function donutChart() {
        let total_collection = document.getElementById("total_collection").value;
        let total_assign = document.getElementById("total_assign").value;

        let due = total_assign - total_collection;


        window.donutChart = Morris.Donut({
            element: 'donutChart',
            data: [{label: 'Total Collection', value: total_collection}, {label: 'Due', value: due}],
            colors: ['#7c32ff', '#c738d8'],
            resize: true,
            redraw: true
        });
    }

    // CK Editor
    if ($('#ckEditor').length) {
        CKEDITOR.replace('ckEditor', {
            skin: 'moono',
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode: CKEDITOR.ENTER_P,
            toolbar: [
                {
                    name: 'basicstyles',
                    groups: ['basicstyles'],
                    items: ['Bold', 'Italic', 'Underline', '-', 'TextColor', 'BGColor']
                },
                {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                {name: 'scripts', items: ['Subscript', 'Superscript']},
                {
                    name: 'justify',
                    groups: ['blocks', 'align'],
                    items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent']
                },
                {name: 'links', items: ['Link', 'Unlink']},
                {name: 'insert', items: ['Image']},
                {name: 'spell', items: ['jQuerySpellChecker']},
                {name: 'table', items: ['Table']}
            ]
        });
    }

    if ($('.active-testimonial').length) {
        $('.active-testimonial').owlCarousel({
            items: 1,
            loop: true,
            margin: 20,
            dots: true,
            autoplay: true,
            nav: true,
            rtl: true,
            navText: [
                "<img src='public/backend/img/client/prev.png' alt='' />",
                "<img src='public/backend/img/client/next.png'  alt='' />"
            ]
        });
    }

    // Mpabox
    if ($('#mapBox').length) {
        let $lat = $('#mapBox').data('lat');
        let $lon = $('#mapBox').data('lon');
        let $zoom = $('#mapBox').data('zoom');
        let $marker = $('#mapBox').data('marker');
        let $info = $('#mapBox').data('info');
        let $markerLat = $('#mapBox').data('mlat');
        let $markerLon = $('#mapBox').data('mlon');
        let map = new GMaps({
            el: '#mapBox',
            lat: $lat,
            lng: $lon,
            scrollwheel: false,
            scaleControl: true,
            streetViewControl: false,
            panControl: true,
            disableDoubleClickZoom: true,
            mapTypeControl: false,
            zoom: $zoom,
            styles: [
                {
                    featureType: 'water',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            color: '#dcdfe6'
                        }
                    ]
                },
                {
                    featureType: 'transit',
                    stylers: [
                        {
                            color: '#808080'
                        },
                        {
                            visibility: 'off'
                        }
                    ]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [
                        {
                            visibility: 'on'
                        },
                        {
                            color: '#dcdfe6'
                        }
                    ]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            color: '#ffffff'
                        }
                    ]
                },
                {
                    featureType: 'road.local',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            visibility: 'on'
                        },
                        {
                            color: '#ffffff'
                        },
                        {
                            weight: 1.8
                        }
                    ]
                },
                {
                    featureType: 'road.local',
                    elementType: 'geometry.stroke',
                    stylers: [
                        {
                            color: '#d7d7d7'
                        }
                    ]
                },
                {
                    featureType: 'poi',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            visibility: 'on'
                        },
                        {
                            color: '#ebebeb'
                        }
                    ]
                },
                {
                    featureType: 'administrative',
                    elementType: 'geometry',
                    stylers: [
                        {
                            color: '#a7a7a7'
                        }
                    ]
                },
                {
                    featureType: 'road.arterial',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            color: '#ffffff'
                        }
                    ]
                },
                {
                    featureType: 'road.arterial',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            color: '#ffffff'
                        }
                    ]
                },
                {
                    featureType: 'landscape',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            visibility: 'on'
                        },
                        {
                            color: '#efefef'
                        }
                    ]
                },
                {
                    featureType: 'road',
                    elementType: 'labels.text.fill',
                    stylers: [
                        {
                            color: '#696969'
                        }
                    ]
                },
                {
                    featureType: 'administrative',
                    elementType: 'labels.text.fill',
                    stylers: [
                        {
                            visibility: 'on'
                        },
                        {
                            color: '#737373'
                        }
                    ]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.icon',
                    stylers: [
                        {
                            visibility: 'off'
                        }
                    ]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [
                        {
                            visibility: 'off'
                        }
                    ]
                },
                {
                    featureType: 'road.arterial',
                    elementType: 'geometry.stroke',
                    stylers: [
                        {
                            color: '#d6d6d6'
                        }
                    ]
                },
                {
                    featureType: 'road',
                    elementType: 'labels.icon',
                    stylers: [
                        {
                            visibility: 'off'
                        }
                    ]
                },
                {},
                {
                    featureType: 'poi',
                    elementType: 'geometry.fill',
                    stylers: [
                        {
                            color: '#dadada'
                        }
                    ]
                }
            ]
        });
    }
    // for crm marge field update
    $('.marge_field_open').on('click', function () {
        $('.tab_marge_wrap').toggleClass('tab_marge_wrap_active');
    });

    $(document).click(function (event) {
        if (!$(event.target).closest(".marge_field_open ,.tab_marge_wrap").length) {
            $("body").find(".tab_marge_wrap").removeClass("tab_marge_wrap_active");
        }
    });

    // for MENU POPUP
    $('.popUP_clicker').on('click', function () {
        $('.menu_popUp_list_wrapper').toggleClass('active');
    });

    $(document).click(function (event) {
        if (!$(event.target).closest(".popUP_clicker ,.menu_popUp_list_wrapper").length) {
            $("body").find(".menu_popUp_list_wrapper").removeClass("active");
        }
    });

    // for MENU notification
    $('.bell_notification_clicker').on('click', function () {
        $('.Menu_NOtification_Wrap').toggleClass('active');
    });

    $(document).click(function (event) {
        if (!$(event.target).closest(".bell_notification_clicker ,.Menu_NOtification_Wrap").length) {
            $("body").find(".Menu_NOtification_Wrap").removeClass("active");
        }
    });

    // OPEN CUSTOMERS POPUP
    $('.pop_up_form_hader').on('click', function () {
        $('.company_form_popup').toggleClass('Company_Info_active');
        $('.pop_up_form_hader').toggleClass('Company_Info_opened');
    });

    $(document).click(function (event) {
        if (!$(event.target).closest(".pop_up_form_hader ,.company_form_popup").length) {
            $("body").find(".company_form_popup").removeClass("Company_Info_active");
            $("body").find(".pop_up_form_hader").removeClass("Company_Info_opened");
        }
    });


    // CHAT_MENU_OPEN
    $('.CHATBOX_open').on('click', function () {
        $('.CHAT_MESSAGE_POPUPBOX').toggleClass('active');
    });
    $('.MSEESAGE_CHATBOX_CLOSE').on('click', function () {
        $('.CHAT_MESSAGE_POPUPBOX').removeClass('active');
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".CHAT_MESSAGE_POPUPBOX, .CHATBOX_open").length) {
            $("body").find(".CHAT_MESSAGE_POPUPBOX").removeClass("active");
        }
    });


    // add_action
    $('.add_action').on('click', function () {
        $('.quick_add_wrapper').toggleClass('active');
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".quick_add_wrapper, .add_action").length) {
            $("body").find(".quick_add_wrapper").removeClass("active");
        }
    });


    // filter_text
    $('.filter_text span').on('click', function () {
        $('.filterActivaty_wrapper').toggleClass('active');
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".filterActivaty_wrapper , .filter_text span").length) {
            $("body").find(".filterActivaty_wrapper").removeClass("active");
        }
    });


    //active courses option
    $(".leads_option_open").on("click", function () {
        $(this).parent(".dots_lines").toggleClass("leads_option_active");
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".dots_lines").length) {
            $("body")
                .find(".dots_lines")
                .removeClass("leads_option_active");
        }
    });
// ######  inbox style icon ######
    $('.favourite_icon i').on('click', function (e) {
        $(this).toggleClass("selected_favourite"); //you can list several class names
        e.preventDefault();
    });


// ######  copyTask style #######
    $(".CopyTask_clicker").on("click", function () {
        $(this).parent("li.copy_task").toggleClass("task_expand_wrapper_open");
    });
    $(document).click(function (event) {
        if (!$(event.target).closest("li.copy_task").length) {
            $("body")
                .find("li.copy_task")
                .removeClass("task_expand_wrapper_open");
        }
    });

// ######  copyTask style #######
    $(".Reminder_clicker").on("click", function () {
        $(this).parent("li.Set_Reminder").toggleClass("task_expand_wrapper_open");
    });
    $(document).click(function (event) {
        if (!$(event.target).closest("li.Set_Reminder").length) {
            $("body")
                .find("li.Set_Reminder")
                .removeClass("task_expand_wrapper_open");
        }
    });

// Crm_table_active
    if ($('.Crm_table_active').length) {
        $('.Crm_table_active').DataTable({
            bLengthChange: false,
            "bDestroy": true,
            language: {
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            columnDefs: [{
                visible: false
            }],
            responsive: true,
            searching: false,
        });
    }

// Crm_table_active 2
    if ($('.Crm_table_active2').length) {
        $('.Crm_table_active2').DataTable({
            bLengthChange: false,
            "bDestroy": false,
            language: {
                search: "<i class='ti-close'></i>",
                searchPlaceholder: 'SEARCH HERE',
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            columnDefs: [{
                visible: false
            }],
            responsive: true,
            searching: false,
            paging: false,
            info: false
        });
    }


// TABS DATA TABLE ISSU
    // data table responsive problem tab
    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
        });
    });


    $(document).ready(function () {
        $(document).ready(function () {

            // $(".note_add_form").hide(3000);

            $(".Add_note").click(function () {
                $(".note_add_form").slideToggle(900);
            });
        });
    });


    $(document).on('click', '.remove', function () {
        $(this).parents('.row_lists').fadeOut();
    });
    $(document).ready(function () {
        $('.add_single_row').click(function () {
            $('.row_lists:last').before('<tr class="row_lists"> <td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"> <textarea class="placeholder_invoice_textarea" placeholder="-" ></textarea> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0 pr-0 remove" style="border:0"> <div class="items_min_icon "><i class="fas fa-minus-circle"></i></div></td></tr>');
        });
    })
// nestable for drah and drop
//     $(document).ready(function () {
//         $('#nestable').nestable({
//             group: 1
//         })
//
//     });


// METU SET UP
    $(".edit_icon").on("click", function () {
        let target = $(this).parent().find('.menu_edit_field');
        $(this).toggleClass("expanded");
        target.slideToggle();
        $('.menu_edit_field').not(target).slideUp();
    });

// SCROLL NAVIGATION
    $(document).ready(function () {
        // scroll /
        $('.scroll-left-button').click(function (event) {
            event.preventDefault();
            $('.scrollable_tablist').animate({
                scrollLeft: "+=300px"
            }, "slow");
        });

        $('.scroll-right-button ').click(function (event) {
            event.preventDefault();
            $('.scrollable_tablist').animate({
                scrollLeft: "-=300px"
            }, "slow");
        });
    });

// FOR CUSTOM TAB
    $(function () {
        $('#theme_nav li label').on('click', function () {
            $('#' + $(this).data('id')).show().siblings('div.Settings_option').hide();
        });
        $('#sms_setting li label').on('click', function () {
            $('#' + $(this).data('id')).show().siblings('div.sms_ption').hide();
        });
    });

})(jQuery);


function setNavigation() {
    let current = location.href;

    let url = document.getElementById('url').value;


    let previousUrl = document.referrer;


    let i = 0;

    $('#sidebar ul li ul li a').each(function () {
        let $this = $(this);
        // if the current path is like this link, make it active
        if ($this.attr('href') == current) {
            i++;
            $this.closest('.list-unstyled').addClass('show');
            // $('#sidebar ul li a').removeClass('active');
            $this.closest('.list-unstyled').siblings('.dropdown-toggle').addClass('active');
            $this.addClass('active');
        }
    });

    if (current == url + '/' + 'admin-dashboard') {

        i++;

        $('#admin-dashboard').addClass('active');
    }


    if (i == 0) {
        $('#sidebar ul li ul li a').each(function () {
            let $this = $(this);
            // if the current path is like this link, make it active
            if ($this.attr('href') == previousUrl) {
                i++;
                $this.closest('.list-unstyled').addClass('show');
                // $('#sidebar ul li a').removeClass('active');
                $this.closest('.list-unstyled').siblings('.dropdown-toggle').addClass('active');
                $this.addClass('active');
            }
        });
    }


    if (current == url + '/' + 'exam-attendance-create') {

        $('#subMenuExam').addClass('show');
        $('#subMenuExam').closest('.list-unstyled').siblings('.dropdown-toggle').addClass('active');
        $("#sidebar a[href='" + url + '/' + "exam-attendance']").addClass('active');
    }


}

// PAGE ACTIVE
$("#sidebar_menu").find("a").removeClass("active");
$("#sidebar_menu").find("li").removeClass("mm-active");
$("#sidebar_menu").find("li ul").removeClass("mm-show");

let current = window.location.pathname
$("#sidebar_menu >li a").filter(function () {

    let link = $(this).attr("href");

    if (link) {
        let check_url = link.indexOf(current);
        // console.log(check_url);
        if (check_url != -1) {
            // console.log('match');
            $(this).parents().parents().children('ul.mm-collapse').addClass('mm-show').closest('li').addClass('mm-active');
            $(this).addClass('active');
            return false;
        }
    }
});


function deleteId() {
    let id = $('.deleteStudentModal').data("id")
    $('#student_delete_i').val(id);

}

// CRM TABLE 3

var fileInput = document.getElementById("upload_content_file");
if (fileInput) {
    fileInput.addEventListener("change", showFileName);

    function showFileName(event) {
        let fileInputRow = event.srcElement;
        let fileName = fileInputRow.files[0].name;
        document.getElementById(
            "placeholderUploadContent"
        ).placeholder = fileName;
    }
}
