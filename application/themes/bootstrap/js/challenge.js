$(document).ready(function () {
    $("#challenge").addClass("active");

    $(".remove_button").click(function () {
        var c = confirm("are you sure?");
        if (c) {
            var stationId = $(this).attr('station_id');
            RemoveStation(stationId);
            $(this).parent().parent().remove();
        }
    });

    $(".remove_response").click(function () {
        var c = confirm("are you sure?");
        if (c) {
            var id = $(this).attr('response_id');
            DeleteResponse(id);
            $(this).parent().parent().remove();
        }
    });

});

function AddStation(item) {
    var stationId = $(item).attr('station_id');
    var challengeId = $("#txtId").val();
    var data_string = 'challengeId=' + challengeId + '&stationId=' + stationId;
    $.ajax({
        type: "POST",
        url: BASE_URI + "challenge/addcstemp",
        data: data_string,
        success: function (data_form) {
            $('.status').html('Add station successfully.').css('color', "blue");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('.status').html('station is existed.').css('color', "red");
        }
    });
}

function RemoveStation(stationId) {
    var challengeId = $("#txtId").val();
    var data_string = 'challengeId=' + challengeId + '&stationId=' + stationId;
    $.ajax({
        type: "POST",
        url: "removecstemp",
        data: data_string,
        success: function (data_form) {
            if (data_form) {
                $('.status').html('remove station successfully.');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('.status').html('error.');
        }
    });
}

function DeleteResponse(id) {
    var data_string = 'Id=' + id;
    $.ajax({
        type: "POST",
        url: "delete_response",
        data: data_string,
        success: function (data_form) {

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}







