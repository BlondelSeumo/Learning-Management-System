$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '#download', function(e) {
    e.preventDefault();
    var url = $(this).data('href');
    var msg = 'Download';

    swal({
            title: 'Are you sure?',
            text: msg,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66cc99',
            cancelButtonColor: '#ff6666',
            confirmButtonText: 'Yes, Do it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        })
        .then((result) => {
            if (result.value) {
                $('#download_buttons').hide();
                $('#on_progress').show();
                $.ajax({
                    url: url,
                    method: 'POST',
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    dataType: 'JSON',
                    success: function(data) {
                        toastr.success(data.message, 'Success');
                        if (data.goto) {
                            setTimeout(function() {
                                window.location.href = data.goto;
                            }, 2000);
                        }
                    },
                    error: function(data) {
                        ajax_error(data);
                    }
                });
            }
        });
});

$(document).on('click', '#direct_update', function(e) {
    e.preventDefault();
    var url = $(this).data('href');
    var msg = 'Update';
    var build = $(this).data('build');
    var version = $(this).data('version');

    swal({
            title: 'Are you sure?',
            text: msg,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#66cc99',
            cancelButtonColor: '#ff6666',
            confirmButtonText: 'Yes, Do it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        })
        .then((result) => {
            if (result.value) {
                $('#download_buttons').hide();
                $('#on_progress').show();
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        'version': version,
                        'build': build
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        toastr.success(data.message, 'Success');
                        if (data.goto) {
                            setTimeout(function() {
                                window.location.href = data.goto;
                            }, 2000);
                        }
                    },
                    error: function(data) {
                        ajax_error(data);
                    }
                });
            }
        });
});

$(document).ready(function(){ 
    $('.preloader').fadeOut('slow');
});