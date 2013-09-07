$(document).ready(function () {

    $(".remove_button").click(function () {
        var c = confirm("are you sure?");
        if (c) {
            var station_id = $(this).attr('station_id');
            RemoveArea(station_id, this);
        }
    });


    $("#area").addClass("active");

});


function AddArea(item) {
    var station_id = $(item).attr('station_id');
    var areaId = $("#txtId").val();
    var data_string = 'areaId=' + areaId + '&stationId=' + station_id;
    $.ajax({
        type: "POST",
        url: "addastemp",
        data: data_string,
        success: function (data_form) {
            $('.status').html('Add station successfully.').css('color', "blue");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('.status').html('station is existed.').css('color', "red");
            console.log(xhr);
        }
    });
}
function RemoveArea(stationId, item) {
    var areaId = $("#txtId").val();
    var data_string = 'areaId=' + areaId + '&stationId=' + stationId;
    $.ajax({
        type: "POST",
        url: BASE_URI + "area/removeastemp",
        data: data_string,
        success: function (data_form) {
            //if (data_form) {
            //   $('.status').html('remove station successfully.');
            //}
            $(item).parent().parent().remove();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}
