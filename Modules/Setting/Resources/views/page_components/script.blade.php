@push('scripts')
    <script type="text/javascript">
        function update_active_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('update_activation_status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function (data) {
                if (data == 1) {
                    toastr.success(
                        "Operation Done Successfully",
                        "Success", {
                            timeOut: 5000,
                        }
                    );
                } else {
                    toastr.warning(
                        "Something went wrong",
                        "Warning", {
                            timeOut: 5000,
                        }
                    );
                }
            });
        }

        function smtp_form() {
            var mail_mailer = $('#mail_mailer').val();
            if (mail_mailer == 'smtp') {
                $('#sendmail').hide();
                $('#smtp').show();
            } else if (mail_mailer == 'sendmail') {
                $('#smtp').hide();
                $('#sendmail').show();
            }
        }


        function calCommission() {
            var admin_comm = document.getElementById('admin_comm').value;
            if (admin_comm > 100) {
                toastr.error('Commission should not more than 100', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            }
            var result = 100 - admin_comm;
            document.getElementById('instructor_comm').value = result;

            console.log(result);
        }


        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview1").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput1").change(function () {
            readURL1(this);
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview2").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $(".imgInput2").change(function () {
            readURL2(this);
        });


        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(".imagePreview3").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }


        $(".imgInput3").change(function () {
            readURL3(this);
        });


        $(document).ready(function () {
            smtp_form();
            $('#form_data_id').on('submit', function (event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('company_information_update') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data == 1) {
                            toastr.success("Operation Done Successfully", 'Success');
                            location.reload();

                        } else if (data == 2) {
                            toastr.success("For demo version,Update only time zone & currency ", 'Success');
                            location.reload();

                        } else {
                            toastr.error(
                                "Something went wrong", "Warning"
                            );
                        }
                    }
                })
            });

        });


        function company_info_form_submit() {
            var company_name = $('#company_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var vat_number = $('#vat_number').val();
            var address = $('#address').val();
            var country_name = $('#country_name').val();
            var zip_code = $('#zip_code').val();
            var company_info = $('#company_info').val();
            $.post('{{ route('company_information_update') }}', {
                _token: '{{ csrf_token() }}',
                company_name: company_name,
                email: email,
                vat_number: vat_number,
                address: address,
                country_name: country_name,
                zip_code: zip_code,
                company_info: company_info
            }, function (data) {
                if (data == 1) {
                    toastr.success(
                        "Operation Done Successfully",
                        "Success", {
                            timeOut: 5000,
                        }
                    );
                } else {
                    toastr.warning(
                        "Something went wrong",
                        "Warning", {
                            timeOut: 5000,
                        }
                    );
                }
            });
        }


        function planCalCommission() {
            var admin_comm = document.getElementById('admin_comm').value;


            if (admin_comm > 100) {
                document.getElementById('admin_comm').value = admin_comm.slice(0, -1);
                toastr.error('Commission should not more than 100', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            }
            if (admin_comm < 0) {
                document.getElementById('admin_comm').value = 0;
                document.getElementById('instructor_comm').value = 100;
                toastr.error('Commission should not less than 0', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            }
            if (admin_comm <= 100 && admin_comm >= 0) {
                document.getElementById('instructor_comm').value = 100 - admin_comm;
            }
        }
    </script>
@endpush
