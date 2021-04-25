    $(document).ready(function() {
        $("#Acategory_id").on("change", function() {
            var url = $("#url").val();
            // console.log(url);

            var formData = {
                id: $(this).val(),
            };
            // get section for student
            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: url + "/" + "admin/course/ajaxGetCourseSubCategory",
                success: function(data) {
                    // console.log(data);
                    var a = "";
                    // $.loading.onAjax({img:'loading.gif'});
                    $.each(data, function(i, item) {
                        if (item.length) {
                            $("#Asubcategory_id").find("option").not(":first").remove();
                            $("#AsubCategoryDiv ul").find("li").not(":first").remove();

                            $.each(item, function(i, section) {
                                $("#Asubcategory_id").append(
                                    $("<option>", {
                                        value: section.id,
                                        text: section.name,
                                    })
                                );

                                $("#AsubCategoryDiv ul").append(
                                    "<li data-value='" +
                                    section.id +
                                    "' class='option'>" +
                                    section.name +
                                    "</li>"
                                );
                            });
                        } else {
                            $("#AsubCategoryDiv .current").html("SECTION *");
                            $("#Asubcategory_id").find("option").not(":first").remove();
                            $("#AsubCategoryDiv ul").find("li").not(":first").remove();
                        }
                    });
                    console.log(a);
                },
                error: function(data) {
                    console.log("Error:", data);
                },
            });
        });
        
    $("#Asubcategory_id").on("change", function() {
        var url = $("#url").val();
// console.log('sub');
        var formData = {
            category_id     : $('#Acategory_id').val(),
            subcategory_id  : $('#Asubcategory_id').val(),
        };
        // console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "ajaxGetCourseList",
            success: function(data) { 
                $.each(data, function(i, item) {
                    if (item.length) {
                        $("#Acourse_id").find("option").not(":first").remove();
                        $("#ACourseDiv ul").find("li").not(":first").remove();

                        $.each(item, function(i, course) {
                            $("#Acourse_id").append(
                                $("<option>", {
                                    value: course.id,
                                    text: course.title,
                                })
                            );
                            $("#ACourseDiv ul").append( "<li data-value='" + course.id + "' class='option'>" + course.title + "</li>");
                        });
                    } else {
                        $("#ACourseDiv .current").html("Select A Course *");
                        $("#Acourse_id").find("option").not(":first").remove();
                        $("#ACourseDiv ul").find("li").not(":first").remove();
                    }
                });
                console.log(a);
            },
            error: function(data) {
                console.log("Error:", data);
            },
        });
    });
    });

   console.log('edit');

    $(document).ready(function() {
        $(".edit_category_id").on("change", function() {
            var url = $("#url").val();
            
            var course_id = $(this).closest('#course').data('course_id');
            console.log(url);
            var formData = {
                id: $(this).val(),
            };
            console.log(course_id);

            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: url + "/" + "admin/course/ajaxGetCourseSubCategory",
                success: function(data) {
                    console.log("#edit_subcategory_id"+course_id);
                    console.log("#edit_subCategoryDiv"+course_id+" ul");
                    var a = "";
                    // $.loading.onAjax({img:'loading.gif'});
                    $.each(data, function(i, item) {
                        if (item.length) {
                            $("#edit_subcategory_id"+course_id).find("option").not(":first").remove();
                            $("#edit_subCategoryDiv"+course_id+" ul").find("li").not(":first").remove();

                            $.each(item, function(i, section) {
                                $("#edit_subcategory_id"+course_id).append(
                                    $("<option>", {
                                        value: section.id,
                                        text: section.name,
                                    })
                                );

                                $("#edit_subCategoryDiv"+course_id+" ul").append(
                                    "<li data-value='" +
                                    section.id +
                                    "' class='option'>" +
                                    section.name +
                                    "</li>"
                                );
                            });
                        } else {
                            $("#edit_subCategoryDiv"+course_id+".current").html("SECTION *");
                            $("#edit_subcategory_id"+course_id).find("option").not(":first").remove();
                            $("#edit_subCategoryDiv"+course_id+" ul").find("li").not(":first").remove();
                        }
                    });
                    console.log(a);
                },
                error: function(data) {
                    console.log("Error:", data);
                },
            });

        });
    });

$(document).ready(function(){
    $('#course_2').change(function(){
    if(this.checked)
    
        $('#price_div').fadeOut('slow');
    else
         $('#price_div').fadeIn('slow');
});

});
$(document).ready(function(){
    $('#course_3').change(function(){
    if(this.checked)
         $('#discount_price_div').fadeIn('slow');
    else
        $('#discount_price_div').fadeOut('slow');
});
});
 

$(document).ready(function(){
    $('.edit_course_2').change(function(){
        var course_id=$(this).val();
        console.log(course_id);
    if(this.checked)
        $('#edit_price_div'+course_id).fadeOut('slow');
    else
         $('#edit_price_div'+course_id).fadeIn('slow');
});

});
$(document).ready(function(){
    $('.edit_course_3').change(function(){
          var course_id=$(this).val();
           console.log(course_id);
    if(this.checked)
         $('#edit_discount_price_div'+course_id).fadeIn('slow');
    else
        $('#edit_discount_price_div'+course_id).fadeOut('slow');
});
});