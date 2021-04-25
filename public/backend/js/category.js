function update_active_status(el) {
    let url = $('.status_route').val();
    let token = $('.csrf_token').val();
    if (el.checked) {
        let status = 1;
    } else {
        let status = 0;
    }
    $.post(url, {
        _token: token,
        id: el.value,
        status: status
    },
        function (data) {
            if (data.message == "success") {
                toastr.success('Success', 'Status has been changed');
            } else {
                toastr.error('Error', 'Ops, Something went wrong');
            }
        });
}
if ($('#table_id_table').length) {
    $('#table_id_table').DataTable({
        language: {
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        bFilter: false,
        bLengthChange: false
    });
}

if ($('#table_id_table_one').length) {
    $('#table_id_table_one').DataTable({
        language: {
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        bFilter: false,
        bLengthChange: false
    });
}

if ($('#table_id, .school-table-data').length) {
    $('#table_id, .school-table-data').DataTable({
        bLengthChange: false,
        "bDestroy": true,
        language: {
            search: "<i class='ti-search'></i>",
            searchPlaceholder: 'Quick Search',
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                text: '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i>',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [{
            visible: false
        }],
        responsive: true,
    });
}
