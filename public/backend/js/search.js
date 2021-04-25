

function showResult(str) {

    var url = $('#url').val();


    $.ajax({
        method: 'POST',
        url: url + '/' + 'search',
        data: {search: str},
        success: function (data) {
            // console.log(data);
            $("#livesearch").show();
            console.log(data);
            $("#livesearch").html(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }

    });

}

