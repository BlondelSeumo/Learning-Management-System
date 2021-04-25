$(document).ready(function () {

    $('#vidBox').VideoPopUp({
        backgroundColor: "#17212a",
        opener: "playTrailer",
        maxweight: "340",
        idvideo: "videoPlayer"
    });

    function playVimeoYoutubeVideo() {
        $('#playTrailer').videoPopup({
            autoplay: 1,
            controlsColor: 'white',
            showVideoInformations: 0,
            width: 600,
            customOptions: {
                rel: 0,
                end: 60
            }
        });

    }


    $('#playTrailer').click(function (e) {
        e.preventDefault();
        let host = $(this).data('host');
        let link = $(this).attr('href');
        let baseUrl = $('#baseUrl').val();

        if (host == 'Youtube') {
            playVimeoYoutubeVideo();
        } else if (host == 'Vimeo') {
            playVimeoYoutubeVideo();

        } else {
            // } else if (host == 'Self') {
            $('#SelfVideoPlayer').toggle('click');
        }


    });

    $('.goFullScreen').click(function (e) {
        e.preventDefault();
        let course = $(this).data('course');
        let lesson = $(this).data('lesson');
        var url = $('.base_url').val();
        window.location.replace(url + '/fullscreen-view/' + course + '/' + lesson);

    });
    $('.course_play_name').click(function (e) {
        e.preventDefault();
        $('#SelfVideoPlayer').toggle('click');
        var lesson = $(this).closest(".curriculam_single").find('.lesson_name');
        let host = lesson.data('host');
        let url = lesson.data('url');
        console.log(lesson);
        // console.log(host);
        // console.log(url);
        // alert(host+"="+url)

        if (url != "" && host != "") {

            if (host == "Youtube") {
                $('#video_url').attr('href', url);
                $(".popup-video").trigger("click");
            } else if (host == "Vimeo") {
                $('.vimeo_video').data('vimeo-id', host);
            } else {

                $('#SelfVideoPlayer').data('host', host);
                $('#SelfVideoPlayer').attr('href', url);
                $('#SelfVideoPlayer').toggle('click');


            }
        } else {
            return false
        }
    });

    $('.quizLink').click(function (e) {
        e.preventDefault();
        window.location.href = $(this).data('url');

    })
    /*  $('.course_play_name').click(function (e) {
          e.preventDefault();
          var lesson = $(this).parent().find('.lesson_name');
          let host = lesson.data('host');
          let url = lesson.data('url');
          console.log(host);
          // alert(host+"="+url)
          if (url != "" && host != "") {

              if (host == "Youtube") {
                  $('#video_url').attr('href', url);
                  console.log(url);
                  $(".popup-video").trigger("click");
              } else {
                  $('.vimeo_video').data('vimeo-id', host);
              }
          } else {
              return false
          }
      });
  */
    let hasStartTime = $("body").hasClass("class_start_time");
    if (hasStartTime) {
        var start_time = $('.class_start_time').val();
        // Set the date we're counting down to
        var countDownDate = new Date(start_time).getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("timer").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
            }
        }, 1000);
    }

});

function Rates(val, id) {
    console.log(val);
    document.getElementById('rating_course_id').value = id;
    document.getElementById('rating_value').value = val;
    $("#myModal").modal();
}

function copyCurrentUrl() {
    var copyText = window.location.href;
    console.log(copyText);
    var dummy = $('<input>').val(copyText).appendTo('body').select()
    document.execCommand('copy')
    setTimeout(function () {
        toastr.success('Link Copied Successfully', 'Success Alert', {
            "iconClass": 'customer-info'
        }, {
            timeOut: 2000
        });
    }, 500);
}

function goFullScreen(course_id, lesson_id) {

    var url = $('.base_url').val();
    window.location.replace(url + '/fullscreen-view/' + course_id + '/' + lesson_id);

}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var url = getCookie("url");
    var host = getCookie("host");
    console.log(host);
// alert(host+"="+url)
    if (url != "" && host != "") {
        if (host == "Youtube") {
            $('#video_url').attr('href', url);
            $(".popup-video").trigger("click");
            setCookie('url', "");
            setCookie('host', "");
        } else {
            $('.vimeo_video').data('vimeo-id', host);
        }
    } else {
        return false
    }
}

function setCookie(cname, cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


$("body").on("click", ".reply_btn", function (e) {
    e.preventDefault();


    let reply_btn = $(this);
    let reply = reply_btn.data('comment');
    let reply_form = $('.reply_form_' + reply);
    if (reply_form.is(':visible')) {
        reply_form.addClass('d-none');
        reply_btn.html('Reply <i class="fas fa-chevron-right"></i> ');
    } else {
        hideOtherForm();
        reply_form.removeClass('d-none');

        reply_btn.html('Cancel Reply <i class="fas fa-chevron-right"></i>');

    }
    showMainForm();
});


$("body").on("click", ".reply2_btn", function (e) {
    e.preventDefault();



    let reply_btn = $(this);
    let reply = reply_btn.data('reply');

    let reply_form = $('.reply2_form_' + reply);
    if (reply_form.is(':visible')) {
        reply_form.addClass('d-none');
        reply_btn.html('Reply <i class="fas fa-chevron-right"></i> ');
    } else {
        hideOtherForm();
        reply_form.removeClass('d-none');
        reply_btn.html('Cancel Reply <i class="fas fa-chevron-right"></i>');
    }
    showMainForm();
});

function hideOtherForm() {
    let inputForm = $('.inputForm');
    inputForm.addClass('d-none');

}

function showMainForm() {
    if ($("#mainComment").hasClass("d-none")){
        $('.reply2_btn').html('Reply <i class="fas fa-chevron-right"></i> ');
        $('.reply_btn').html('Reply <i class="fas fa-chevron-right"></i> ');
    }

    let totalVisible = $('.inputForm:visible').length;
    console.log(totalVisible);
    if (totalVisible ==0) {
        $('#mainComment').removeClass('d-none');
    } else {
        $('#mainComment').addClass('d-none');

    }
}
