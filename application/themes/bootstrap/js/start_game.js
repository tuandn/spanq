/**
 * Created with JetBrains PhpStorm.
 * User: Administrator
 * Date: 7/3/13
 * Time: 8:38 AM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function () {

    $(".remove_button").click(function () {
        var c = confirm("Are you sure?");
        if (c) {
            var station_id = $(this).attr('station_id');
            RemoveStation(station_id);
            $(this).parent().parent().remove();
        }
    });


});

function AddStation(item) {
    var gameId = $("#txtId").val();
    var max_station = $("#txt_max_station").val() - 1;

    var data_string = 'stationId=' + $(item).attr("station_id") + '&game_id=' + gameId + '&max_station=' + max_station;
    $.ajax({
        type: "POST",
        url: BASE_URI + "startgame/add_gs_temp",
        data: data_string,
        success: function (data) {
            $('.status').addClass('success-inline').html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //$('.status').html('Station is existed.').css('color', "red");
            console.log(xhr);
        }
    });
}
function RemoveStation(stationId) {
    var gameId = $("#txtId").val();
    //var no_of_team = $("#txt_no_of_team").val();
    var data_string = 'stationId=' + stationId + '&game_id=' + gameId;
    $.ajax({
        type: "POST",
        url: BASE_URI + "startgame/remove_gs_temp",
        data: data_string,
        success: function (data) {
            //$("#txt_no_of_team").val(data.toString());
            console.log($("#txt_no_of_team").val());
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function goBack() {
    var gameId = $("#txtId").val();
    var c = confirm("Are you sure to want go back?");
    /*if (c) {
     $(".remove_button").each(function () {

     var station_id = $(this).attr('station_id');
     RemoveStation(station_id);
     });
     }*/
    location.href = BASE_URI + "startgame/view?gameId=" + gameId + "&type=update";
}

function goBack_Station() {
    var gameId = $("#txt_game_id").val();
    location.href = BASE_URI + "startgame/station?game_id=" + gameId;
}

function go_to_define_team() {
    var max_station = parseInt($("#txt_max_station").val()) - 1;
    var current_station = $("table#game_station tr td input").length;

    if (current_station == max_station) {
        var no_of_team = $("#txt_no_of_team").val();
        var gameId = $("#txtId").val();
        window.location.href = BASE_URI + "startgame/define_team?no_of_team=" + no_of_team + '&game_id=' + gameId;
    } else {
        alert("You have add enough " + max_station + " station.");
    }

}


function go_to_game_summary() {
    var no_of_team = $("#txt_no_of_team").val();
    var gameId = $("#txtId").val();
    window.location.href = BASE_URI + "startgame/game_summary?no_of_team=" + no_of_team + '&game_id=' + gameId;
}

function validate_start_game() {
    var no_of_team = $("#txt_no_of_team").val();
    for (i = 1; i <= no_of_team; i++) {
        var value = $("#txtTeamName" + i).val();
        if (value == null || value == "") {
            $("#status-team-" + i).html("field is required!");
            $("#txtTeamName" + i).focus();
            return false;
        } else {
            $("#status-team-" + i).html("");
        }
    }
    return true;
}

/*
 function valid_field(item){
 var text = $(item).val();
 if(text.trim() != ""){
 $(item).parent().find("span").html("");
 }
 }*/
