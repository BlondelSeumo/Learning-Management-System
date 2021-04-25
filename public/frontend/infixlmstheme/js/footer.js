function getList() {
    $('.shoping_cart ,.dark_overlay').toggleClass('active');

    let url = $('.item_list').val();
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: url,

        success: function (data) {
            $('#cartView').empty();
            let output = '';
            $.each(data, function (k, v) {
                output += '<div class="single_cart">'
                    + '<div class="thumb" style="background-image: url(' + v.image + ')">'
                    // + ' <img src="' + v.image + ' " alt="">'
                    + ' </div>'
                    + ' <div class="cart_content">   <h5>' + v.title + '</h5> <p><span class="prise">' + v.price + '</span></p>   </div> </div>';


            });
            console.log(data.length);
            if (data.length == 0) {
                output += '<div class="single_cart"> <h4>No Item into cart</h4> </div>';
            } else {
                $('.view_checkout_btn').show();
            }


            $('#cartView').html(output);
        }
    });
}
$(document).on('click', '.cart_store', function (e) {
    e.preventDefault();
    let btn =$(this);
    let id = $(this).data('id');
    let url = $('.enroll_cart').val();
    let csrf_token = $('.csrf_token').val();
    if ($.isNumeric(id)) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url +'/' + id,
            data: {
                _token: csrf_token
            },
            success: function (data) {

                if (data['result'] === "failed") {
                    toastr.error(data['message']);
                    btn.show();
                } else {
                    toastr.success(data['message']);
                    btn.hide();
                }
                if (data.type === 'addToCart') {
                    $('.notify_count').html(data.total);
                    getList();
                } else {

                }

            }
        });

    } else {
        getList();
    }


});
$(".stripe-button-el").remove();
$(".razorpay-payment-button").hide();
