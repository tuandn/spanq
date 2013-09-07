$(document).ready(function () {

    $(".remove_button").click(function () {
        var c = confirm("are you sure?");
        if (c) {
            var challengeId = $(this).attr('challenge_id');
            RemoveChallenge(challengeId);
            $(this).parent().parent().remove();
        }
    });

});

function AddChallenge(item) {
    var stationId = $("#txtId").val();
    var data_string = 'challengeId=' + $(item).attr('challenge_id') + '&stationId=' + stationId;
    $.ajax({
        type: "POST",
        url: BASE_URI + "station/addcstemp",
        data: data_string,
        success: function (data_form) {
            $('.status').html('Add challenge successfully.').css('color',"blue");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('.status').html('challenge is existed.').css('color',"red");
        }
    });
}
function RemoveChallenge(challengeId) {
    var stationId = $("#txtId").val();
    var data_string = 'challengeId=' + challengeId + '&stationId=' + stationId;
    $.ajax({
        type: "POST",
        url: BASE_URI + "station/removecstemp",
        data: data_string,
        success: function (data_form) {
            if (data_form) {
                $('.status').html('remove challenge successfully.');
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('.status').html('error.');
        }
    });
}
