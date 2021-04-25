$('.selectAll').click(function (e) {
    if ($(this).hasClass('checkedAll')) {
        $('input').prop('checked', false);
        $(this).removeClass('checkedAll');
    } else {
        $('input').prop('checked', true);
        $(this).addClass('checkedAll');
    }


});
//
$('body').on('click', '.question', function () {

    let totalQuestions = $('#totalQuestions');
    let totalMarks = $('#totalMarks');

    let online_exam_id = $('#online_exam_id').val();
    let ques_assign = $('.ques_assign').val();
    let token = $('.csrf_token').val();
    let selectedQus = [];

    //todo check only question
    $("input[type='checkbox']").each(function () {
        if ($(this).is('.question:checked')) {
            selectedQus.push($(this).val());
        }
    });
    console.log(selectedQus);

    if (!$(this).is(':checked')) {
        $("#questionSelectAll").prop('checked', false);
    }
    $.ajax({
        type: 'POST',
        url: ques_assign,
        data: {
            '_token': token,
            online_exam_id: online_exam_id,
            questions: selectedQus,
        },
        success: function (data) {
            totalQuestions.html(data.totalQus);
            totalMarks.html(data.totalMarks);
            toastr.success('Successfully Assign', 'Success');
        },
        error: function (data) {
            console.log(data);
            toastr.error('Something went wrong!', 'Error Alert')
            location.reload();
        }
    });

});

function setQuestionTime() {
    var checkStatus = document.getElementById("set_question_time").checked;
    var perQTime = document.getElementById('per_question_time');
    var totalQTime = document.getElementById('total_question_time');
    if (checkStatus) {
        perQTime.style.display = "block";
        totalQTime.style.display = "none";
    } else {
        perQTime.style.display = "none";
        totalQTime.style.display = "block";
    }
}

function changeQuestionReview() {
    var checkStatus = document.getElementById("questionReview").checked;
    var showResult = document.getElementById('showResultDiv');
    if (checkStatus) {
        showResult.style.display = "none";
    } else {
        showResult.style.display = "block";
    }
}
