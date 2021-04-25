(function ($) {
    "use strict";
    //js code here

    //monthly revenue chart js
    // var ctx = document.getElementById('myChart').getContext('2d');
    // var chart = new Chart(ctx, {
    //     type: 'line',
    //     data: {
    //         labels: ['1','3','5','7','9','11','13','15','17','19','21','23','25','27','29','31'],
    //         datasets: [{
    //             label: 'Earning',
    //             backgroundColor: 'rgba(255, 59, 0, .1)',
    //             borderColor: 'rgba(255, 59, 0, 1)',
    //             data: [0, 5, 5, 10, 15, 15, 15,15,20,20,25,25,25,30,32],
    //             pointBorderWidth: 1,
    //             pointRadius: 0,
    //             lineTension: 0,
    //             borderWidth: 2,
    //         }]
    //     },
    //     options: {
    //       legend: {
    //         position: "none"
    //     },
    //     }
    // });

    //niceselect select jquery
    $(document).ready(function() {
      $('.nice_Select, .select_address, #product_short_list').niceSelect();
      $('#datepicker').datepicker();
    });

    //progressbar js
    var delay = 500;
    $(".progress-bar").each(function(i){
        $(this).delay( delay*i ).animate( { width: $(this).attr('aria-valuenow') + '%' }, delay );

        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: delay,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now)+'%');
            }
        });
    });

    //active sidebar
    $('.sidebar_icon').on('click', function(){
        $('.sidebar').toggleClass('active_sidebar');
    });
    $('.sidebar_close_icon i').on('click', function(){
        $('.sidebar').removeClass('active_sidebar');
    });
    //remove sidebar
    $(document).click(function(event){
        if (!$(event.target).closest(".sidebar_icon, .sidebar").length) {
            $("body").find(".sidebar").removeClass("active_sidebar");
        }
    })

    //responsive table js
    var table_rs = $('.table_responsive')
    if(table_rs.length){
      table_rs.DataTable( {
        language: {
			search: "<i class='ti-search'></i>",
			searchPlaceholder: 'Search all contact here...',
			paginate: {
				next: "<i class='ti-angle-right'></i>",
				previous: "<i class='ti-angle-left'></i>"
			}
		},
        responsive: true,
        "ordering": false
      });
    }

}(jQuery));