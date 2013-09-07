<?php
$no_invalid = array(
    'id' => "txtNoInvalid",
    'name' => 'txtNoInvalid',
    'value' => $checkin_d->NoInvalid
, 'disabled' => "disabled"
);

$pen_invalid = array(
    'id' => "txtPenInvalid",
    'name' => 'txtPenInvalid',
    'value' => $checkin_d->PenaltyPerInvalid
, 'disabled' => "disabled"
);

$max_no = array(
    'id' => "txtMaxNoPen",
    'name' => 'txtMaxNoPen',
    'value' => $checkin_d->MaxNo
, 'disabled' => "disabled"
);

$max_point = array(
    'id' => "txtMaxPoint",
    'name' => 'txtMaxPoint',
    'value' => $checkin_d->MaxPoint
, 'disabled' => "disabled"
);

$e_base_point = array(
    'id' => "txtEBasePoint",
    'name' => 'txtEBasePoint',
    'value' => $challenge_d->E_BasePoint
, 'disabled' => "disabled"
);
/*$max_point_mini = array(
    'id' => "txtMaxPointMini",
    'name' => 'txtMaxPointMini',
    'value' => $checkin_d->Maxpoint_GameMini
, 'disabled' => "disabled"
);*/
$e_pen = array(
    'id' => "txtEpen",
    'name' => 'txtEpen',
    'value' => $challenge_d->E_PenaltyPerFail
, 'disabled' => "disabled"
);

$e_max_no = array(
    'id' => "txtEMaxNo",
    'name' => 'txtEMaxNo',
    'value' => $challenge_d->E_MaxNo
, 'disabled' => "disabled"
);
$d_base_point = array(
    'id' => "txtDBasePoint",
    'name' => 'txtDBasePoint',
    'value' => $challenge_d->D_BasePoint
, 'disabled' => "disabled"
);

$d_pen = array(
    'id' => "txtDpen",
    'name' => 'txtDpen',
    'value' => $challenge_d->D_PenaltyPerFail
, 'disabled' => "disabled"
);

$d_max_no = array(
    'id' => "txtDMaxNo",
    'name' => 'txtDMaxNo',
    'value' => $challenge_d->D_MaxNo
, 'disabled' => "disabled"
);
?>
<script type="text/javascript">

    $(document).ready(function () {
        $("#game").addClass("active");

    });

    function Send() {
        var message = $("#txtMessage").val().trim();
        var type = 1;
        var list_reg_id = $("#cbTeam").val();
        if (message != "") {
            if ($("#all_team").is(":checked")) {
                list_reg_id = $("#txtListRegId").val();
                type = 1;
            }
            if (list_reg_id != "") {
                var data_string = 'list_reg_id=' + list_reg_id + '&message=' + message + '&type=' + type;
                $.ajax({
                    type: "POST",
                    url: BASE_URI + "game/send_notify_message",
                    data: data_string,
                    success: function (data_form) {
                        console.log(data_form);
                        $(".status_send").css("color", "blue").html("Send message successfully.");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $(".status_send").css("color", "red").html("Can't send message.");
                    }
                });
            } else {
                $(".status_send").css("color", "red").html("Can't get register id.");
            }
        } else {
            $(".status_send").css("color", "red").html("Please enter message.");
        }
    }


    //tuandn 2013/08/10 add start
    function Send_To_HQ() {
        var message = "Race To HQ";
        var list_reg_id = $("#cbTeam").val();
        if ($("#chkRace").is(":checked")) {
            var result = confirm('You are sure want enable race to HQ?');
            if (!result) {
                $('#chkRace').prop('checked', false);
                return false;
            }
            list_reg_id = $("#txtListRegId").val();
            console.log(list_reg_id);
            if (list_reg_id != "") {
                var data_string = 'list_reg_id=' + list_reg_id + '&message=' + message + '&type=' + 2;
                $.ajax({
                    type: "POST",
                    url: BASE_URI + "game/send_notify_message",
                    data: data_string,
                    success: function (data_form) {
                        console.log(data_form);
                        $(".status_send").css("color", "blue").html("Send message successfully.");
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $(".status_send").css("color", "red").html("Can't send message.");
                    }
                });
            } else {
                $(".status_send").css("color", "red").html("Can't get register id.");
            }
        } else {
            //$(".status_send").css("color", "red").html("Please enter message.");
        }
    }
    //tuandn 2013/08/10 add end

</script>
<div id="content-header">
    <h1>All games</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>game" class="current">All Games</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>Game Summary</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post">
                        <div class="control-group">
                            <label class="control-label">Game Type</label>

                            <div class="controls">
                                <select name="cboGameType" style="width: 300px;">
                                    <option value="<?php echo $game_summary->Id; ?>">
                                        <?php echo $game_summary->Name . " > " . $game_summary->QuestionDifficulty . " Question"; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Area</label>

                            <div class="controls">
                                <select name="cbArea" style="width: 300px;">
                                    <option value="<?php echo $area->Id; ?>">
                                        <?php echo $area->Name; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>

                            <div class="controls">
                                <input class="check_box"
                                       type="checkbox" <?php echo isset($game_summary->AllowPossible) && $game_summary->AllowPossible ? "checked" : ""; ?>
                                       name="chkRace" id="chkRace" onchange="return Send_To_HQ();">
                                Race HQ Enabled
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Start time</label>

                            <div class="controls">
                                <input type="text" id="txtStations" name="txtStations"
                                       value="<?php echo $game_summary->StartTime; ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Time remain</label>

                            <div class="controls">
                                <input type="text" id="txtTeams" name="txtTeams"
                                       value="<?php echo $game_summary->TimeRemain; ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">No of Stations</label>

                            <div class="controls">
                                <input type="text" id="txtStations" name="txtStations"
                                       value="<?php echo $game_summary->NoOfStations; ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">No of Teams</label>

                            <div class="controls">
                                <input type="text" id="txtTeams" name="txtTeams"
                                       value="<?php echo $game_summary->NoOfTeam; ?>"/>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a href="#" id="open-check_in-modal" class="btn btn-primary">Checkin settings</a>
                            <a href="#" id="open-challenge-modal" class="btn btn-primary">Challenge setting</a>
                            <a href="#" id="open-message-modal" class="btn btn-primary">Send message</a>
                        </div>
                    </form>
                </div>

            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Teams</h5>

                </div>
                <div class="widget-content nopadding">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: left;">Pos.</th>
                            <th style="text-align: left;">Team</th>
                            <th style="text-align: left;">% Comp.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($list_team_comp as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item['Pos']; ?></td>
                                <td style="text-align: left;"><?php echo $item['Team']; ?></td>
                                <td style="text-align: left;"><?php echo $item['Comp']; ?>%</td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-message-option" title="Send Message">
    <div class="widget-box">
        <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
            <h5 class="status_send"></h5>

        </div>
        <div class="widget-content nopadding">
            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Message</label>

                    <div class="controls">
                        <textarea name="txtMessage" id="txtMessage"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Teams</label>

                    <div class="controls">
                        <select name="cbTeam" id="cbTeam" style="width: 200px;">
                            <?php foreach ($list_team as $item): ?>
                                <option
                                    value="<?php echo $item->regId; ?>"> <?php echo $item->Name; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">All Teams</label>

                    <div class="controls">
                        <input type="checkbox" name="all_team" id="all_team"/>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="button" value="Send" class="btn btn-primary" id="btn_send" onclick="Send();">
                    <input type="hidden" id="txtListRegId" value="<?php echo $list_reg_id; ?>"/>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal-check_in-option" title="Checkin Settings">
    <div class="widget-box">
        <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
            <h5 class="status"></h5>

        </div>
        <div class="widget-content nopadding">
            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">No invalid checkin allow before deduction</label>

                    <div class="controls">
                        <?php echo form_input($no_invalid) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">% Penalty invalid checkin</label>

                    <div class="controls">
                        <?php echo form_input($pen_invalid) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Max no penalties</label>

                    <div class="controls">
                        <?php echo form_input($max_no) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Max point</label>

                    <div class="controls">
                        <?php echo form_input($max_point) ?>
                    </div>
                </div>
                <!--<div class="control-group">
                    <label class="control-label">Max Point for game mini</label>

                    <div class="controls">
                        <?php /*echo form_input($max_point_mini) */?>
                    </div>
                </div>-->
            </form>
        </div>
    </div>
</div>
<div id="modal-challenge-option" title="Challenge Settings">
    <div class="widget-box">
        <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
            <h5 class="status"></h5>

        </div>
        <div class="widget-content nopadding">
            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">Easy challenge base point</label>

                    <div class="controls">
                        <?php echo form_input($e_base_point) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">% Penalty per fail</label>

                    <div class="controls">
                        <?php echo form_input($e_pen) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Max no attemps before zero</label>

                    <div class="controls">
                        <?php echo form_input($e_max_no) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Difficult challenge base point</label>

                    <div class="controls">
                        <?php echo form_input($d_base_point) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">% Penalty per fail</label>

                    <div class="controls">
                        <?php echo form_input($d_pen) ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Max no attemps before zero</label>

                    <div class="controls">
                        <?php echo form_input($d_max_no) ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
