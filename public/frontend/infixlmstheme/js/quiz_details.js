let runner;
let totalQus = $('.total_ques').val();
var base_url = $('.base_url').val();
$(document).ready(function () {
    $("#prev").click(function (e) {
        let question_review = $('.question_review').val();
        if (question_review == 1) {
            e.preventDefault();
            getQusAndSubmit(0, 0, 0, 1);
        }
    });
    $("#submit").click(function (e) {
        e.preventDefault();
        submitQuiz();
    });
    //skip qus
    $("#skip").click(function (e) {
        e.preventDefault();
        getQusAndSubmit(0, 0, 0, 1);
    });
    $("#next").click(function (e) {
        e.preventDefault();
        let ans = $(".question:visible").find('.ans:checked').val();

        if (ans == "undefined" || ans == "" || ans == null) {
            toastr.error('Please select a option', 'Error Alert', {
                timeOut: 2000
            });
            return false;
        }
        getQusAndSubmit(0, 0, 1, 0);
    });
    $(document).on('click', '.ans', function (e) {
        $("#rightAns").hide();
        $("#wrongAns").hide();
        let courseId = $("#courseId").val();
        let quizId = $("#quizId").val();
        let qusAns = $(this).val();
        let show_result = $('.show_result_each_submit').val();
        $("#skip").hide();
        $.ajax({
            type: 'POST',
            url: base_url + '/submit_ans',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                courseId: courseId,
                quizId: quizId,
                qusAns: qusAns,
            },
            success: function (data) {
                if (show_result == 1) {
                    if (data.result) {
                        $("#rightAns").show();
                        $("#wrongAns").hide();
                    } else {
                        $("#rightAns").hide();
                        $("#wrongAns").show();

                    }
                } else {
                    $("#wrongAns").hide();
                    $("#rightAns").hide();
                }
                toastr.success('Submit Answer', 'Success', {
                    timeOut: 2000
                });

            }
            ,
            error: function (data) {
                toastr.error('Already Submit Answer', 'Error Alert', {
                    timeOut: 2000
                });
            }
        });
    });
});

function copyCurrentUrl() {
    var copyText = window.location.href;
    console.log(copyText);
    var dummy = $('<input>').val(copyText).appendTo('body').select()
    document.execCommand('copy')
    setTimeout(function () {
        toastr.success('Link Copied Successfully', 'Success Alert', {
            timeOut: 2000
        });
    }, 500);
    //start quiz
    $("#startQuiz").click(function (e) {
        e.preventDefault();
        $(".displayStartPage").hide(500);
        $(".displayTimer").show(500);
        $(".displayQuiz").show(500);

        getQusAndSubmit(0, 0, 1, 0);
        startTimer();
    });
}

//get qus & submit
function getQusAndSubmit(submit, skip, next, prev) {
    $("#rightAns").hide();
    $("#wrongAns").hide();
    $("#prev").hide();
    $("#skip").hide();
    $("#next").hide();
    $("#submit").hide();


    var currentQus = $("#numberOfQus").val();
    var currentProcess = ((100 / totalQus) * currentQus);

    let courseId = $("#courseId").val();
    let quizId = $("#quizId").val();
    let qusId = $("#qusId").val();
    let ansId = $("#ansId").val();
    let numberOfQus = $("#numberOfQus").val();
    $.ajax({
        type: 'GET',
        url: base_url + '/get_qus_ans',
        data: {
            courseId: courseId,
            quizId: quizId,
            qusId: qusId,
            ansId: ansId,
            numberOfQus: numberOfQus,
            submit: submit,
            skip: skip,
            next: next,
            prev: prev,

        },
        success: function (data) {
            let ans = $(".question:visible").find('.ans:checked').val();
            $("#rightAns").hide();
            $("#wrongAns").hide();
            $(".questions").html(data.output);
            $("#numberOfQus").val(data.numberOfQus);
            $("#numberOfQusCount").html(data.numberOfQus);
            if (submit) {
                $(".progress-bar").attr('aria-valuenow', 100);
                $(".progress-bar").html(100);

            } else {
                $(".progress-bar").attr('aria-valuenow', currentProcess);
                $(".progress-bar").html(currentProcess);
            }

            process();


            if (totalQus === data.numberOfQus) {

                $('#skip').hide();
                $('#prev').show();
                $('#next').hide();
                $('#submit').show();
            } else {
                if (data.numberOfQus === 1) {
                    $('#prev').hide();
                } else {
                    $('#prev').show();
                }


                if (ans == "undefined" || ans == "" || ans == null) {
                    $('#skip').show();
                } else {
                    $('#skip').hide();
                }


                $('#next').show();
                $('#submit').hide();

                if (submit) {
                    $("#rightAns").hide();
                    $("#wrongAns").hide();
                    $("#prev").hide();
                    $("#skip").hide();
                    $("#next").hide();
                    $("#submit").hide();
                }
            }

        },
        error: function (data) {
            toastr.error('Something went wrong!', 'Error Alert', {
                timeOut: 2000
            });
        }
    });
}

function submitQuiz() {
    $(".progress-bar").attr('aria-valuenow', 100);
    $(".progress-bar").html(100);
    process();
    clearTimeout(runner);
    getQusAndSubmit(1, 0, 0, 1);
}

function process() {
    var delay = 500;
    $(".progress-bar").each(function (i) {
        $(this).delay(delay * i).animate({width: $(this).attr('aria-valuenow') + '%'}, delay);

        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: delay,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now) + '%');
            }
        });
    });
}

//check secound
function checkSecond(sec) {
    if (sec < 10 && sec >= 0) {
        sec = "0" + sec;
    }
    // add zero in front of numbers < 10
    if (sec < 0) {
        sec = "59";
    }
    return sec;
}

//start timer
function startTimer() {
    var presentTime = document.getElementById('timer').innerHTML;
    var timeArray = presentTime.split(/[:]+/);
    var m = timeArray[0];
    var s = checkSecond((timeArray[1] - 1));
    if (s == 59) {
        m = m - 1
    }
    if ((m + '').length == 1) {
        m = '0' + m;
    }
    if (m < 0) {
        $(".questions").empty()
        submitQuiz();
        // m = '59';
    } else {
        document.getElementById('timer').innerHTML = m + ":" + s;
        runner = setTimeout(startTimer, 1000);
    }

}

function Rates(val, id) {
    console.log(val);
    document.getElementById('rating_course_id').value = id;
    document.getElementById('rating_value').value = val;
    $("#myModal").modal();
}

function download_pdf() {
    const element = document.getElementById("student-certificate");
    // Choose the element and save the PDF for our user.
    html2pdf().from(element).save();
}
