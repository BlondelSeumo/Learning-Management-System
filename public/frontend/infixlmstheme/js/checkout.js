

$(document).ready(function () {
    var base_url = $('.base_url').val();
    $('.select2').select2();
    $('.select2').css('width','100%')
    $("#applyCoupon").on('click', function (event) {

        event.preventDefault();
        let code = $('#code').val();
        let total = $('#total').val();
        let balance = $('.user_balance').val();
        let balanceInput = $('#balanceInput');
        let sign = $('.currency_symbol').val();
        if (code == "" || total == "") {
            toastr.error('Error', 'Ops, Coupon Code Is Empty');
        } else {


            $.ajax({
                type: "GET",
                data: {code: code, total: total},
                dataType: "json",
                url: base_url+'/StudentApplyCoupon',
                success: function (data) {

                    if (data.error) {
                        // $('#totalBalance').html("23");
                        $('.totalBalance').html(sign + " " + data.total);
                        $('#successMessage').html("");
                        toastr.error('Error', data.error);
                    } else {
                        $('#discountBox').show();
                        $('#couponBox').hide();
                        $('.totalBalance').html(sign + " " + data.total);
                        $('.discountAmount').html(sign + " " + (total - data.total));
                        $('#successMessage').html(data.success);

                        toastr.success('Success', data.success);
                    }
                    if (balance >= data.total) {
                        balanceInput.show();
                    } else {
                        balanceInput.hide();

                    }

                },
                error: function (data) {
                    toastr.error('Error', "Something went wrong");
                },
            });

            // toastr.success('Success', 'Status has been changed');
        }


    });

    $("#cancelCoupon").on('click', function (event) {

        event.preventDefault();

        let total = $('#total').val();
        let balance = $('.user_balance').val();
        let balanceInput = $('#balanceInput');
        let sign = $('.currency_symbol').val();


        $.ajax({
            type: "GET",
            data: {code: 'N/A', total: total},
            dataType: "json",
            url: base_url+'/StudentApplyCoupon',
            success: function (data) {

                if (data.error) {
                    $('#discountBox').hide();
                    $('#couponBox').show();
                    $('#code').val('');
                    $('.totalBalance').html(sign + " " + data.total);
                    $('.discountAmount').html(sign + " " + (total - data.total));
                    toastr.error('Coupon Removed');
                } else {
                    $('.totalBalance').html(sign + " " + data.total);
                    $('#successMessage').html("");
                    toastr.error('Error', 'Something Went Wrong');

                }
                if (balance >= data.total) {
                    balanceInput.show();
                } else {
                    balanceInput.hide();

                }

            },
            error: function (data) {
                toastr.error('Error', "Something went wrong");
            },
        });


    });


    $(document).on('click', '.billing_address', function () {
        let bill = $(this).val();
        if (bill == 'new') {
            $('.billing_form').show();
            $('.billing_heading').show();
            $('.prev_billings').hide();
            $('.billing_info').hide();
        } else {
            $('.billing_form').hide();
            $('.billing_heading').hide();
            $('.prev_billings').show();
            $('.old_billing').trigger('change');
        }
    })


    $(document).on('change', '.old_billing', function () {

        let billing = $(this).find(':selected').data('id');

        $('.billing_name').text(billing.first_name + ' ' + billing.last_name);
        $('.billing_email').text(billing.email);
        $('.billing_phone').text(billing.phone);
        $('.billing_company').text(billing.company_name);
        $('.billing_address').text(billing.address1 + ' ' + billing.address2);
        $('.billing_zip').text(billing.zip_code);
        $('.billing_city').text(billing.city);
        $('.billing_country').text(billing.country.name);
        $('.billing_details').text(billing.details);
        // $('.billing_payment').text(billing.payment_method);
        $('.billing_info').show();
    })
});
