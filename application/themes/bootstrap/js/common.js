$(document).ready(function () {

});

// get location lat long when on_blue address
function set_location_by_address(text_area) {
    var address = $(text_area).val();
    var data_string = 'address=' + address;

    $.ajax({
        type: "POST",
        url: BASE_URI + "landmark/get_location",
        data: data_string,
        success: function (data_form) {
            var json = $.parseJSON(data_form);

            $("#txtLat").val(json['lat']);
            $("#txtLong").val(json['lng']);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });

}

function browserName() {

    var Browser = navigator.userAgent;

    if (Browser.indexOf('MSIE') >= 0) {

        Browser = 'MSIE';

    }

    else if (Browser.indexOf('Firefox') >= 0) {

        Browser = 'Firefox';

    }

    else if (Browser.indexOf('Chrome') >= 0) {

        Browser = 'Chrome';

    }

    else if (Browser.indexOf('Safari') >= 0) {

        Browser = 'Safari';

    }

    else if (Browser.indexOf('Opera') >= 0) {

        Browser = 'Opera';

    }

    else {

        Browser = 'UNKNOWN';

    }

    return Browser;

}
