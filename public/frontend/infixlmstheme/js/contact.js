$(document).ready(function () {
    let lat = $('.lat').val();
    let lng = $('.lng').val();
    let zoom = parseInt($('.zoom').val());
    if ($('#contact-map').length != 0) {
        google.maps.event.addDomListener(window, 'load', basicmap(lat, lng, zoom));
    }
});
