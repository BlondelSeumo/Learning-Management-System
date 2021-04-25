@push('scripts')
    <script>
        $(document).on('click', '.addWidget', function () {
            let demoMode = $('#demoMode').val();
            if (demoMode == 1) {
                toastr.warning("For the demo version, you cannot change this", "Warning");
                return false;
            }
            $('#CreateModal').modal('show');
            let a = $(this).data('type');
             $('#category').val(a);

        });


        @if ($errors->any())

        @endif

        $(document).ready(function () {

            $('#copyright_form').on('submit', function (event) {
                event.preventDefault();

                let demoMode = $('#demoMode').val();
                if (demoMode == 1) {
                    toastr.warning("For the demo version, you cannot change this", "Warning");
                    return false;
                }

                $("#copyrightBtn").prop('disabled', true);
                $('#copyrightBtn').text('Updating');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('footerSetting.footer.content-update') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        toastr.success('Updated successfully!')
                        $('#copyrightBtn').text('{{__('common.Update')}}');
                        $("#copyrightBtn").prop('disabled', false);
                    },
                    error: function (response) {
                        toastr.error('Something wrong !')
                        $('#copyrightBtn').text('{{__('common.Update')}}');
                        $("#copyrightBtn").prop('disabled', false);
                    }
                });
            });

            $('#aboutForm').on('submit', function (event) {
                event.preventDefault();
                let demoMode = $('#demoMode').val();
                if (demoMode == 1) {
                    toastr.warning("For the demo version, you cannot change this", "Warning");
                    return false;
                }
                $("#aboutSectionBtn").prop('disabled', true);
                $('#aboutSectionBtn').text('Updating');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('footerSetting.footer.content-update') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        toastr.success('Updated successfully!')
                        $('#aboutSectionBtn').text('{{__('common.Update')}}');
                        $("#aboutSectionBtn").prop('disabled', false);
                    },
                    error: function (response) {
                        toastr.error('Something wrong !')
                        $('#aboutSectionBtn').text('{{__('common.Update')}}');
                        $("#aboutSectionBtn").prop('disabled', false);
                    }
                });
            });

            $('#aboutDescriptionForm').on('submit', function (event) {
                event.preventDefault();
                let demoMode = $('#demoMode').val();
                if (demoMode == 1) {
                    toastr.warning("For the demo version, you cannot change this", "Warning");
                    return false;
                }
                $("#aboutDescriptionBtn").prop('disabled', true);
                $('#aboutDescriptionBtn').text('Updating');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('footerSetting.footer.content-update') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        toastr.success('Updated successfully!')
                        $('#aboutDescriptionBtn').text('{{__('common.Update')}}');
                        $("#aboutDescriptionBtn").prop('disabled', false);
                    },
                    error: function (response) {
                        toastr.error('Something wrong !')
                        $('#aboutDescriptionBtn').text('{{__('common.Update')}}');
                        $("#aboutDescriptionBtn").prop('disabled', false);
                    }
                });
            });

            $('#companyForm').on('submit', function (event) {
                event.preventDefault();
                let demoMode = $('#demoMode').val();
                if (demoMode == 1) {
                    toastr.warning("For the demo version, you cannot change this", "Warning");
                    return false;
                }
                $("#companyBtn").prop('disabled', true);
                $('#companyBtn').text('Updateing');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('footerSetting.footer.content-update') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        toastr.success('Updated successfully!')
                        $('#companyBtn').text('{{__('common.Update')}}');
                        $("#companyBtn").prop('disabled', false);
                    },
                    error: function (response) {
                        toastr.error('Something wrong !')
                        $('#companyBtn').text('{{__('common.Update')}}');
                        $("#companyBtn").prop('disabled', false);
                    }
                });
            });

            $('#accountForm').on('submit', function (event) {
                event.preventDefault();
                let demoMode = $('#demoMode').val();
                if (demoMode == 1) {
                    toastr.warning("For the demo version, you cannot change this", "Warning");
                    return false;
                }
                $("#accountBtn").prop('disabled', true);
                $('#accountBtn').text('Updating');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('footerSetting.footer.content-update') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        toastr.success('Updated successfully!')
                        $('#accountBtn').text('{{__('common.Update')}}');
                        $("#accountBtn").prop('disabled', false);
                    },
                    error: function (response) {
                        toastr.error('Something wrong !')
                        $('#accountBtn').text('{{__('common.Update')}}');
                        $("#accountBtn").prop('disabled', false);
                    }
                });
            });

            $('#serviceForm').on('submit', function (event) {
                event.preventDefault();
                let demoMode = $('#demoMode').val();
                if (demoMode == 1) {
                    toastr.warning("For the demo version, you cannot change this", "Warning");
                    return false;
                }
                $("#serviceBtn").prop('disabled', true);
                $('#serviceBtn').text('Updating');
                var formElement = $(this).serializeArray()
                var formData = new FormData();
                formElement.forEach(element => {
                    formData.append(element.name, element.value);
                });
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    url: "{{ route('footerSetting.footer.content-update') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        toastr.success('Updated successfully!')
                        $('#serviceBtn').text('{{__('common.Update')}}');
                        $("#serviceBtn").prop('disabled', false);
                    },
                    error: function (response) {
                        toastr.error('Something wrong !')
                        $('#serviceBtn').text('{{__('common.Update')}}');
                        $("#serviceBtn").prop('disabled', false);
                    }
                });
            });


        });

        function sectionControl(id) {
             
            let url = "/footer/footer-setting/tab/" + id;
            $.ajax({
                url: url,
                type: "GET",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {

                },
                error: function (response) {

                }
            });
        }


        function statusChange(item) {
            let demoMode = $('#demoMode').val();
            if (demoMode == 1) {
                toastr.warning("For the demo version, you cannot change this", "Warning");
                return false;
            }
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', item.id);
            formData.append('status', item.status);
            $.ajax({
                url: "{{ route('footerSetting.footer.widget-status') }}",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    toastr.success('Status Change Successfully!')
                },
                error: function (response) {
                    toastr.error('Something wrong !')
                }
            });
        }

        function showEditModal(page) {
            let demoMode = $('#demoMode').val();
            if (demoMode == 1) {
                toastr.warning("For the demo version, you cannot change this", "Warning");
                return false;
            }
            console.log(page);
            $('#editModal').modal('show');
            $('#widget_name').val(page.name).addClass('has-content');
            $("#widget_description").summernote("code", page.description);
            $('#widgetEditId').val(page.id);
            $("#editCategory").val(page.category);
            $('#editCategory').niceSelect('update');

            $("#editPage").val(page.page);
            $('#editPage').niceSelect('update');

            if (page.is_static == 1) {
                // $('#editPageFieldDiv').css("display", "none");
                $('#editCategoryFieldDiv').removeClass("col-lg-12").addClass("col-lg-12");
            } else {
                // $('#editPageFieldDiv').css("display", "inherit");
                $('#editCategoryFieldDiv').removeClass("col-lg-12").addClass("col-lg-12");
            }

        }

        function showDeleteModal(id) {
            let demoMode = $('#demoMode').val();
            if (demoMode == 1) {
                toastr.warning("For the demo version, you cannot change this", "Warning");
                return false;
            }
            $('#deleteItemModal').modal('show');
            let route = '{{url('/')}}/footer/footer-widget-delete/' + id
            $('#deleteBtn').attr('href', route)
        }


    </script>
@endpush

