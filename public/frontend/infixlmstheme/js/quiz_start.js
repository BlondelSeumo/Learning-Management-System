let runner;
let totalQus = $('.quiz_assign').val();
startTimer();

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
        $('.submitBtn').trigger('click');
        // submitQuiz();
        // m = '59';
    } else {
        document.getElementById('timer').innerHTML = m + ":" + s;
        runner = setTimeout(startTimer, 1000);
    }

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


$(".skip").click(function (e) {
    e.preventDefault();
    $('.nav-pills .active').parent().next('li').find('a').trigger('click');
});

$(".next").click(function (e) {
    e.preventDefault();
    let ans = $(".tab-pane:visible").find('.quizAns:checked').val();

    if (ans == "undefined" || ans == "" || ans == null) {
        toastr.error('Please select a option', 'Error Alert', {
            timeOut: 2000
        });
        return false;
    } else {
        $('.nav-pills .active').parent().next('li').find('a').trigger('click');

    }

});
