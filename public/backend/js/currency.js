$( document ).ready(function() {
    $('#add_currency_modal').hide();
});
function open_add_currency_modal(el){
    $('#add_currency_modal').modal('show');
    $('#currency_add').modal('show');
}
function edit_currency_modal(el){
    let url = $('.currency_edit').val();
    let token = $('.csrf_token').val();
    $.post(url, {_token:token, id:el}, function(data){
        $('#edit_form').html(data);
        $('#Item_Edit').modal('show');
    });
}
