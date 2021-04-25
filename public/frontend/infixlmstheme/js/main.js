(function ($) {
    "use strict";

    $(".play_toggle_btn").on("click", function () {
        $('.courseListPlayer').toggleClass("active");
        $('.course_fullview_wrapper').toggleClass("active");
    });
    //* Navbar Fixed
    let nav_offset_top = $('header').height() + 50;
    /*-------------------------------------------------------------------------------
      Navbar
    -------------------------------------------------------------------------------*/
    $(window).on('scroll', function () {
        let scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("navbar_fixed");
            $('#back-top').fadeOut(500);
        } else {
            $("#sticky-header").addClass("navbar_fixed");
            $('#back-top').fadeIn(500);
        }
    });

// MENU ACTIVE
    jQuery(function ($) {
        let path = window.location.href;
        $('.main_menu a').each(function () {
            if (this.href === path) {
                $(this).parents(".submenu").closest('li').addClass('submenu_active');
                $(this).addClass('active');
            }
        });
    });


// back to top
    $('#back-top a').on("click", function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });

// #######################
//   MOBILE MENU
// #######################

    let menu = $('ul#mobile-menu');
    if (menu.length) {
        menu.slicknav({
            prependTo: ".mobile_menu",
            closedSymbol: '<i class="ti-angle-down"></i>',
            openedSymbol: '<i class="ti-angle-up"></i>'
        });
    }
    ;

    //active sidebar
    $(".sidebar_icon").on("click", function () {
        $(".sidebar").toggleClass("active_sidebar");
    });

    $(".sidebar_close_icon i").on("click", function () {
        $(".sidebar").removeClass("active_sidebar");
    });

//remove sidebar
    $(document).click(function (event) {
        if (!$(event.target).closest(".sidebar_icon, .sidebar").length) {
            $("body").find(".sidebar").removeClass("active_sidebar");
        }
    });

    //notification
    $(".notification_open > a").on("click", function () {
        $(".notification_area").toggleClass("active");
    });
//remove sidebar
    $(document).click(function (event) {
        if (!$(event.target).closest(".notification_area,.notification_open > a").length) {
            $("body").find(".notification_area").removeClass("active");
        }
    });
//active courses option
    $(".courses_option, .collaps_icon").on("click", function () {
        $(this)
            .parent(".custom_select, .collaps_part")
            .toggleClass("active");
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".custom_select").length) {
            $("body")
                .find(".custom_select")
                .removeClass("active");
        }
        if (!$(event.target).closest(".collaps_part").length) {
            $("body")
                .find(".collaps_part")
                .removeClass("active");
        }
    });

// wow js
    new WOW().init();
// for MENU POPUP
    $('.cart_store').on('click', function () {
        // $('.shoping_cart ,.dark_overlay').toggleClass('active');
    });
    $('.chart_close').on('click', function () {
        $('.shoping_cart ,.dark_overlay').removeClass('active');
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".cart_store,.shoping_cart").length) {
            $("body").find(".dark_overlay").removeClass("active");
        }
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".cart_store ,.shoping_cart").length) {
            $("body").find(".shoping_cart").removeClass("active");
        }
    });


// select
    if ($('.small_select').length > 0) {
        $('.small_select').niceSelect();
    }
    if ($('.theme_select').length > 0) {
        $('.theme_select').niceSelect();
    }
    if ($('.nice_Select').length > 0) {
        $('.nice_Select').niceSelect();
    }


// BARFILLER
    $(document).ready(function () {
        let proBar1 = $('#bar1');
        if (proBar1.length) {
            proBar1.barfiller({barColor: '#ffd500', duration: 2000});
        }
        let proBar2 = $('#bar2');
        if (proBar2.length) {
            proBar2.barfiller({barColor: '#ffd500', duration: 2100});
        }
        let proBar3 = $('#bar3');
        if (proBar3.length) {
            proBar3.barfiller({barColor: '#ffd500', duration: 2200});
        }

    });

    // only category -menu #####
// menu
//xs device menu
    $('.xs_menu_item_dropdown>ul').hide();
    $(".xs_menu_item_dropdown").on('click', function () {
        $(this).children("ul").slideToggle("100");
        $(this).toggleClass('active_dropdown');
        $(this).find(".dropdown_icon").toggleClass(" ti-angle-up ti-angle-down");
    });


// active one
    $('.xs_menu_item_dropdown').on('click', function () {
        if (!$(this).hasClass('open')) {
        }
        $(this).removeClass('open');
    });

//xs device menu active
    $('.menu_icon').on('click', function () {
        $('.xs_menu').toggleClass('xs_menu_active');
    });
//xs device menu remove
    $('.dropdown_close_icon').on('click', function () {
        $('.xs_menu').removeClass('xs_menu_active');
    });
//xs device menu remove with closeset
    $(document).click(function (event) {
        if (!$(event.target).closest(".header_part").length) {
            $("body").find(".xs_menu").removeClass("xs_menu_active");
        }
    });

//search box js
    $('.secrch_btn').on('click', function () {
        $('.category_box_iner').toggleClass('search_box_active');
    });
//xs search box remove with closeset
    $(document).click(function (event) {
        if (!$(event.target).closest(".header_part").length) {
            $("body").find(".category_box_iner").removeClass("search_box_active");
        }
    });

    $('.menu-item').on('click', function () {
        $('.mega-menu').removeClass('active_megamenu');
    })

//megamenu hover add class
    if ($(window).width() > 1200) {
        $('.dropdown').hover(
            function () {
                $(this).addClass('show')
            },
            function () {
                $(this).removeClass('show')
            }
        )
    }

    $("input[type='email']").bind('focus', function () {
        $(this).css('background-color', 'white !important');
    });

//category select
    $('.category_box_iner .categories_menu, .menu_icon').on('click', function () {
        $(this).closest('.input-group-prepend2').toggleClass('active_menu');
        // $('.input-group-prepend2').toggleClass('active_menu');
    });
//closeset js
    $(document).click(function (event) {
        if (!$(event.target).closest(".input-group-prepend2").length) {
            $("body").find(".input-group-prepend2").removeClass("active_menu");
        }
    });

//menu dropdown
    $(document).ready(function () {
        $('.mega_menu_dropdown').hover(function () {
            $('.mega_menu_dropdown').removeClass('active_menu_item');
            $(this).addClass('active_menu_item');
        })
    });

//menu dropdown
    $(document).ready(function () {
        $('.search_hide').on('click', function () {
            $('.category_box_iner').removeClass('search_box_active');
        })
    });
// #######################
//  package_carousel_active
// #######################
    $('.package_carousel_active').owlCarousel({
        loop: true,
        margin: 30,
        items: 1,
        autoplay: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: false,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 800,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 3
            },
            992: {
                items: 4
            },
            1400: {
                items: 5
            }
        }
    });

    $('.testmonail_active').owlCarousel({
        loop: true,
        margin: 30,
        items: 1,
        autoplay: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        nav: false,
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 800,
        responsive: {
            0: {
                items: 1
            },
            767: {
                items: 1
            },
            992: {
                items: 2
            },
            1500: {
                items: 3
            }
        }
    });
    if ($('.brand_active').length > 0) {
        $('.brand_active').owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            nav: false,
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 2
                },
                767: {
                    items: 4
                },
                992: {
                    items: 5
                },
                1400: {
                    items: 6
                }
            }
        });
    }

    if ($('.pricing_carousel').length > 0) {
        $('.pricing_carousel').owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            nav: false,
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 2
                },
                992: {
                    items: 4
                },
                1400: {
                    items: 5
                }
            }
        });
    }


    // counter
    $('.counter').counterUp({
        delay: 10,
        time: 10000
    });

    /* magnificPopup img view */
    $('.popup-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /* magnificPopup video view */
    $('.popup-video').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });


    // filter items on button click
    $('.portfolio-menu').on('click', 'button', function () {
        let filterValue = $(this).attr('data-filter');
        $grid.isotope({filter: filterValue});
    });

    //for menu active class
    $('.portfolio-menu button').on('click', function (event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });


    /*===============================================
          Parallax business_image
    ================================================*/
    if ($('.man_img').length > 0) {
        $('.man_img').parallax({
            scalarX: 7.0,
            scalarY: 7.0,
        });
    }

    if ($('#mc_embed_signup').length > 0) {
        $('#mc_embed_signup').find('form').ajaxChimp();
    }

    $('.btnNext').click(function () {
        $('.nav-pills .active').parent().next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function () {
        $('.nav-pills .active').parent().prev('li').find('a').trigger('click');
    });

// shoping cart parent hide
    $(".close_icon").on("click", function () {
        $(this).parent().parent().parent().hide(500);
    });

    $('.noBrake').tooltip();

// inc dec number

    (function ($) {

        let cartButtons = $('.product_number_count').find('span');

        $(cartButtons).on('click', function (e) {

            e.preventDefault();
            let $this = $(this);
            let target1 = $this.parent().data('target');
            let target = $('#' + target1);
            let current = parseFloat($(target).val());

            if ($this.hasClass('number_increment'))
                target.val(current + 1);
            else {
                (current < 1) ? null : target.val(current - 1);
            }
        });
    }(jQuery));

    $(document).bind("contextmenu", function (e) {
        e.preventDefault();
    });

    $(document).keydown(function (e) {
        if (e.which === 123) {
            return false;
        }
    });


    document.onkeydown = function (e) {
        if (event.keyCode == 123) {
            return false;
        }

        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }


        if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)) {
            return false;
        }
    }


    $('.navbar .dropdown-item').on('click', function (e) {
        var $el = $(this).children('.dropdown-toggle');
        var $parent = $el.offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        if (!$parent.parent().hasClass('navbar-nav')) {
            if ($parent.hasClass('show')) {
                $parent.removeClass('show');
                $el.next().removeClass('show');
                $el.next().css({"top": -999, "left": -999});
            } else {
                $parent.parent().find('.show').removeClass('show');
                $parent.addClass('show');
                $el.next().addClass('show');
                $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
            }
            e.preventDefault();
            e.stopPropagation();
        }
    });

    $('.navbar .dropdown').on('hidden.bs.dropdown', function () {
        $(this).find('li.dropdown').removeClass('show open');
        $(this).find('ul.dropdown-menu').removeClass('show open');
    });


    $('.menu_item').on('click', function () {
        $(this).closest('.input-group-prepend2').toggleClass('active_menu');
    });
})(jQuery);
