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

$(document).on('click', '.editInstructor', function () {

    let instructor = $(this).data('item');
    console.log(instructor)
    $('#instructorId').val(instructor.id);
    $('#instructorName').val(instructor.name);
    $('#instructorAbout').summernote("code", instructor.about);
    $('#instructorDob').val(instructor.dob);
    $('#instructorPhone').val(instructor.phone);
    $('#instructorEmail').val(instructor.email);
    $('#instructorImage').val(instructor.image);
    $('#instructorFacebook').val(instructor.facebook);
    $('#instructorTwitter').val(instructor.twitter);
    $('#instructorLinkedin').val(instructor.linkedin);
    $('#instructorInstragram').val(instructor.instagram);
    $("#editInstructor").modal('show');

});


$(document).on('click', '.deleteInstructor', function () {
    let id = $(this).data('id');
    $('#instructorDeleteId').val(id);
    $("#deleteInstructor").modal('show');
})

$(document).on('click', '#add_instructor_btn', function () {
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
    $('#addInstagram').val('');
});
