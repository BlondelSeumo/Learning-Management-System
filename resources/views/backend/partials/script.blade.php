@if(isRtl())
    <script src="{{ asset('public') }}/js/popper.min.js"></script>
    <script src="{{asset('public/js/bootstrap.rtl.min.js') }}"></script>
@else
    <script src="{{asset('public/js/bootstrap.bundle.min.js') }}"></script>
@endif
<script src="{{asset('public/backend/js/jquery-ui.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.data-tables.js')}}"></script>
<script src="{{asset('public/backend/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/backend/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/backend/js/jszip.min.js')}}"></script>
<script src="{{asset('public/backend/js/pdfmake.min.js')}}"></script>
<script src="{{asset('public/backend/js/vfs_fonts.min.js')}}"></script>
<script src="{{asset('public/backend/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backend/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backend/js/dataTables.rowReorder.min.js')}}"></script>
<script src="{{asset('public/backend/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backend/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('public/backend/js/nice-select.min.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('public/backend/js/fastselect.standalone.min.js')}}"></script>
<script src="{{asset('public/backend/js/moment.min.js')}}"></script>
<script src="{{asset('public/backend/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('public/backend/js/bootstrap-datepicker.min.js')}}"></script>
<!-- summernote  -->
<script src="{{asset('public/backend/js/summernote-bs4.min.js')}}"></script>
<!-- nestable  -->

<!-- metisMenu js  -->
<script src="{{asset('public/backend/js/metisMenu.min.js')}}"></script>
<!-- progressbar  -->
<script src="{{asset('public/backend/vendors/progressbar/circle-progress.min.js')}}"></script>
<!-- color picker  -->
<script src="{{asset('public/backend/vendors/color_picker/colorpicker.min.js')}}"></script>
<script src="{{asset('public/backend/vendors/color_picker/colorpicker_script.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/backend/js/main.js')}}"></script>
<script src="{{asset('public/backend/js/custom.js')}}"></script>
<script src="{{asset('public/backend/js/footer.js')}}"></script>
<script src="{{asset('public/backend/js/developer.js')}}"></script>
<script src="{{asset('public/backend/js/treeview.js')}}"></script>
<script src="{{asset('public/js/toastr.min.js')}}"></script>
<script src="{{asset('public/backend/vendors/select2/select2.min.js')}}"></script>

<script src="{{asset('public/backend/js/backend.js')}}"></script>
<script src="{{asset('public/backend/js/search.js')}}"></script>

<script>
    if ($('.Crm_table_active3').length) {
        let datatable = $('.Crm_table_active3').DataTable({
            bLengthChange: false,
            "bDestroy": true,
            language: {
                emptyTable: "{{ __("common.No data available in the table") }}",
                search: "<i class='ti-search'></i>",
                searchPlaceholder: '{{__('common.Quick Search')}}',
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="far fa-copy"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: '{{__('common.Copy')}}',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="far fa-file-excel"></i>',
                    titleAttr: '{{__('common.Excel')}}',
                    title: $("#logo_title").val(),
                    margin: [10, 10, 10, 0],
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },

                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="far fa-file-alt"></i>',
                    titleAttr: '{{__('common.CSV')}}',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="far fa-file-pdf"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: '{{__('common.PDF')}}',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    margin: [0, 0, 0, 12],
                    alignment: 'center',
                    header: true,
                    customize: function (doc) {
                        doc.content[0].table.widths =
                            Array(doc.content[0].table.body[0].length + 1).join('*').split('');
                    }

                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: '{{__('common.Print')}}',
                    title: $("#logo_title").val(),
                    exportOptions: {
                        columns: ':not(:last-child)',
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

        $(".selectAllQuiz").on("click", function () {
            let totalQuestions = $('#totalQuestions');
            let totalMarks = $('#totalMarks');

            if ($(this).is(':checked')) {
                datatable.$("input[type='checkbox']").prop('checked', true);
            } else {
                datatable.$("input[type='checkbox']").prop('checked', false);
            }
            let online_exam_id = $('#online_exam_id').val();
            let ques_assign = $('.ques_assign').val();
            let token = $('.csrf_token').val();
            var myCheckboxes = [];
            datatable.$("input[type='checkbox']").each(function () {
                if ($(this).is(':checked')) {
                    myCheckboxes.push($(this).val());
                }
            });
            $.ajax({
                type: 'POST',
                url: ques_assign,
                data: {
                    '_token': token,
                    online_exam_id: online_exam_id,
                    questions: myCheckboxes,
                },
                success: function (data) {
                    totalQuestions.html(data.totalQus);
                    totalMarks.html(data.totalMarks);
                    toastr.success('{{__('common.Successfully Assign')}}', '{{__('common.Success')}}');
                },
                error: function (data) {
                    toastr.error('{{__('common.Something Went Wrong')}}', '{{__('common.Error')}}')
                }
            });
        });

    }
</script>
<script>
    setTimeout(function () {
        $('.preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    }, 0);
</script>
@stack('scripts')
