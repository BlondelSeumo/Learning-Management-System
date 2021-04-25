    $(document).ready(function() {
        $("#category_id").on("change", function() {
            var url = $("#url").val();
            console.log(url);

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
                    console.log(data);
                    var a = "";
                    // $.loading.onAjax({img:'loading.gif'});
                    $.each(data, function(i, item) {
                        if (item.length) {
                            $("#subcategory_id").find("option").not(":first").remove();
                            $("#subCategoryDiv ul").find("li").not(":first").remove();

                            $.each(item, function(i, section) {
                                $("#subcategory_id").append(
                                    $("<option>", {
                                        value: section.id,
                                        text: section.name,
                                    })
                                );

                                $("#subCategoryDiv ul").append(
                                    "<li data-value='" +
                                    section.id +
                                    "' class='option'>" +
                                    section.name +
                                    "</li>"
                                );
                            });
                        } else {
                            $("#subCategoryDiv .current").html("SECTION *");
                            $("#subcategory_id").find("option").not(":first").remove();
                            $("#subCategoryDiv ul").find("li").not(":first").remove();
                        }
                    });
                    console.log(a);
                },
                error: function(data) {
                    console.log("Error:", data);
                },
            });
        });
        
    $("#subcategory_id").on("change", function() {
        var url = $("#url").val();

        var formData = {
            category_id     : $('#category_id').val(),
            subcategory_id  : $(this).val(),
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "ajaxGetCourseList",
            success: function(data) { 
                $.each(data, function(i, item) {
                    if (item.length) {
                        $("#course_id").find("option").not(":first").remove();
                        $("#CourseDiv ul").find("li").not(":first").remove();

                        $.each(item, function(i, course) {
                            $("#course_id").append(
                                $("<option>", {
                                    value: course.id,
                                    text: course.title,
                                })
                            );
                            $("#CourseDiv ul").append( "<li data-value='" + course.id + "' class='option'>" + course.title + "</li>");
                        });
                    } else {
                        $("#CourseDiv .current").html("Select A Course *");
                        $("#course_id").find("option").not(":first").remove();
                        $("#CourseDiv ul").find("li").not(":first").remove();
                    }
                });
                console.log(a);
            },
            error: function(data) {
                console.log("Error:", data);
            },
        });
    });
    $("#course_id").on("change", function() {
        var url = $("#url").val();

        var formData = {
            category_id     : $('#category_id').val(),
            subcategory_id  : $('#subcategory_id').val(),
            course_id  : $(this).val(),
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: "json",
            url: url + "/" + "ajaxGetQuizList",
            success: function(data) { 
                console.log(data);
                $.each(data, function(i, item) {
                    if (item.length) {
                        $("#quiz_id").find("option").not(":first").remove();
                        $("#quiz_div ul").find("li").not(":first").remove();

                        $.each(item, function(i, course) {
                            $("#quiz_id").append(
                                $("<option>", {
                                    value: course.id,
                                    text: course.title,
                                })
                            );
                            $("#quiz_div ul").append( "<li data-value='" + course.id + "' class='option'>" + course.title + "</li>");
                        });
                    } else {
                        $("#quiz_div .current").html("Select A Course *");
                        $("#quiz_id").find("option").not(":first").remove();
                        $("#quiz_div ul").find("li").not(":first").remove();
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



