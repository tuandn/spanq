<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:51 PM
 * To change this template use File | Settings | File Templates.
 */
$no_of_stations = array(
    'id' => "txtStations",
    'name' => 'txtStations',
    'value' => isset($list_game->NoOfStations) ? $list_game->NoOfStations : "",
    'onblur' => "check_max_station();"
);

$no_of_teams = array(
    'id' => "txtTeams",
    'name' => 'txtTeams',
    'value' => isset($list_game->NoOfTeam) ? $list_game->NoOfTeam : ""
);
$game_name = array(
    'id' => "txtGameName",
    'name' => 'txtGameName',
    'value' => isset($list_game->GameName) ? $list_game->GameName : ""
);

$phone_hint = array(
    'id' => "txtPhoneHint",
    'name' => 'txtPhoneHint',
    'value' => isset($list_game->phonehint) ? $list_game->phonehint : ""
);

?>

<script type="text/javascript">
    var max_station = 0;
    $(document).ready(function () {
        $("#cbArea").change();
        question_change("#chkRob");
    });
    //delete row common by id
    function Delete(id) {
        var data_string = 'Id=' + id;
        $.ajax({
            type: "POST",
            url: BASE_URI + "station/delete_by",
            data: data_string,
            success: function (data_form) {
                location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("There was an error. Check constraint please !");
            }
        });
    }
    function check_station_by_area_id(item) {
        var area_id = $(item).val();
        if (area_id != "0") {
            var area = $(item).find("option:selected").text();
            var data_string = 'area_id=' + area_id;
            $.ajax({
                type: "POST",
                url: BASE_URI + "startgame/check_station_by_area_id",
                data: data_string,
                success: function (data_form) {
                    if (data_form > 0) {
                        max_station = data_form - 1;
                        $("#cbArea-help-inline").removeClass("error-inline").addClass('success-inline').html(area + " available " + max_station
                            + " station.");
                        $("#btn_submit").removeAttr("disabled");

                    }
                    else {
                        max_station = 0;
                        $("#cbArea-help-inline").removeClass("error-inline").addClass("error-inline").html(area + " not contain any station.");
                        $("#btn_submit").removeAttr("disabled").attr("disabled", true);

                    }
                    var station = $("#txtStations").val();
                    if ($.isNumeric(station)){
                        check_max_station();
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                }
            });
        }else{
            $("#cbArea-help-inline").html("");
            $("#btn_submit").removeAttr("disabled").attr("disabled", true);
        }
        return false;
    }

    function check_max_station() {
        var station = $("#txtStations").val();
        if ($.isNumeric(station) && station > max_station && max_station > 0) {

            alert("No of station limited is " + max_station)
            $("#txtStations").focus();
            return false;
        }
    }
    function question_change(item){
        if($(item).is(":checked")){
            $("#answer").show();
        }else{
            $("#answer").hide();
        }
        $('select').select2();
    }
</script>


<div id="content-header">
    <h1>Start a Game</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <!--<a href="<?php /*echo base_url(); */?>response" class="current">Responses</a>-->
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>Game Parameters</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="startgame/generate_random_station"
                          name="startgame_validate"
                          id="startgame_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Game name</label>

                            <div class="controls">
                                <?php echo form_input($game_name) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Game Type</label>

                            <div class="controls">
                                <select name="cboGameType" style="width: 300px;">
                                    <?php foreach ($game_type as $item): ?>
                                        <option
                                            value="<?php echo $item->Id; ?>" <?php echo isset($list_game->GameTypeId) && $list_game->GameTypeId == $item->Id ? "selected" : ""; ?> ><?php echo $item->Name; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>

                            <div class="controls">
                                <input
                                    class="check_box" <?php echo isset($list_game->Enabled20Quetion) && $list_game->Enabled20Quetion ? "checked" : ""; ?>
                                    type="checkbox" name="chkRob" id="chkRob" onchange="question_change(this)">Enable 20 Question
                            </div>
                        </div>
                        <div class="control-group" id="answer">
                            <label class="control-label">Answer</label>

                            <div class="controls">
                                <select name="cbAnswer" id="cbAnswer" style="width: 300px;">
                                    <?php foreach ($list_answer as $item): ?>
                                        <option
                                            value="<?php echo $item->Id; ?>" <?php echo isset($list_game->AnswerId) && $list_game->AnswerId == $item->Id ? "selected" : "" ?> ><?php echo $item->Answer; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Question Difficulty</label>

                            <div class="controls">
                                <select name="cboDiff" style="width:300px;">
                                    <option
                                        value="Easy" <?php echo isset($list_game->QuestionDifficulty) && $list_game->QuestionDifficulty == "Easy" ? "selected" : ""; ?>  >
                                        Easy
                                    </option>
                                    <option
                                        value="Difficulty" <?php echo isset($list_game->QuestionDifficulty) && $list_game->QuestionDifficulty == "Difficulty" ? "selected" : ""; ?> >
                                        Difficulty
                                    </option>
                                    <option
                                        value="Choice Offered" <?php echo isset($list_game->QuestionDifficulty) && $list_game->QuestionDifficulty == "Choice Offered" ? "selected" : ""; ?> >
                                        Choice
                                        Offered
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Area</label>

                            <div class="controls">
                                <?php echo $listArea; ?>
                                <span id="cbArea-help-inline"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Time Limit</label>

                            <div class="controls">
                                <select name="cboTimeLimit" style="width: 300px;">
                                    <?php foreach ($time_limit as $item): ?>
                                        <option
                                            value="<?php echo $item->Value; ?>" <?php echo isset($list_game->TimeLimit) && $list_game->TimeLimit == $item->Value ? "selected" : ""; ?> ><?php echo $item->Text; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">No of Stations</label>

                            <div class="controls">
                                <?php echo form_input($no_of_stations) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">No of Teams</label>

                            <div class="controls">
                                <?php echo form_input($no_of_teams) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Phone hint</label>

                            <div class="controls">
                                <?php echo form_input($phone_hint) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>

                            <div class="controls">
                                <input class="check_box"
                                       type="checkbox" <?php echo isset($list_game->AllowPossible) && $list_game->AllowPossible ? "checked" : ""; ?>
                                       name="chkRace" id="chkRace">
                                Allow Possible Return to Race HQ
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" value="Generate Random Station >" class="btn btn-primary"
                                   id="btn_submit"/>
                            <input type="hidden" id="txt_game_id" name="txt_game_id"
                                   value="<?php echo isset($list_game->Id) ? $list_game->Id : ""; ?>"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#start_game").addClass("active");
        $("#game_parameter").addClass("active");

        $("#btn_submit").attr("disabled", true);
    });
</script>




