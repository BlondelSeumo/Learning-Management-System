

$(document).ready(function () {
    $(".stripe-button-el").remove();
    $(".razorpay-payment-button").hide();

    $('.submitBtn').css('cursor', 'pointer');
    $('.stripeSubmitBtn').css('cursor', 'pointer');
    $('.razorSubmitBtn').css('cursor', 'pointer');


    $('body').on('click', '.submitBtn', function () {
        $(this).closest("form").submit();
    });

    $('body').on('click', '.stripeSubmitBtn', function () {
        $(".stripeSubmit").trigger('click');
    });

    $('body').on('click', '.razorSubmitBtn', function () {
        $(this).closest("form").submit();
    });
});
