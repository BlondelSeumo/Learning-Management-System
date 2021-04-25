
$(document).on('click', '.editBlog', function () {

    let blog = $(this).data('item');
    console.log(blog)
    $('#BlogId').val(blog.id);
    $('#title').val(blog.title);
    $('#image').val(blog.image);
    $('#description').summernote("code", blog.description);

    $("#editBlog").modal('show');

});


$(document).on('click', '.deleteBlog', function () {
    let id = $(this).data('id');
    $('#blogDeleteId').val(id);
    $("#deleteBlog").modal('show');
})
