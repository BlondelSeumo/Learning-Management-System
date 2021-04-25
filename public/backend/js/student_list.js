$(".toggle-password").click(function () {

    var input = $(this).closest('.input-group').find('input');

    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
$(".imgBrowse").change(function (e) {
    e.preventDefault();
    var file = $(this).closest('.primary_file_uploader').find('.imgName');
    var filename = $(this).val().split('\\').pop();
    file.val(filename);
});

$(document).on('click', '.editStudent', function () {

    let student = $(this).data('item');
    $('#studentId').val(student.id);
    $('#studentName').val(student.name);
    $('#studentAbout').summernote("code", student.about);
    $('#studentDob').val(student.dob);
    $('#studentPhone').val(student.phone);
    $('#studentEmail').val(student.email);
    $('#studentImage').val(student.image);
    $('#studentFacebook').val(student.facebook);
    $('#studentTwitter').val(student.twitter);
    $('#studentLinkedin').val(student.linkedin);
    $('#studentYoutube').val(student.youtube);
    $("#editStudent").modal('show');

});


$(document).on('click', '.deleteStudent', function () {
    let id = $(this).data('id');
    $('#studentDeleteId').val(id);
    $("#deleteStudent").modal('show');
});


$(document).on('click', '#add_student_btn', function () {
    $('#addName').val('');
    $('#addAbout').html('');
    $('#startDate').val('');
    $('#addPhone').val('');
    $('#addEmail').val('');
    $('#addPassword').val('');
    $('#addCpassword').val('');
    $('#addFacebook').val('');
    $('#addTwitter').val('');
    $('#addLinked').val('');
    $('#addYoutube').val('');
});


