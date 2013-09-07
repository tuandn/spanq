<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 7/2/13
 * Time: 10:34 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<style type="text/css">
    .max_station {
        float: left;
        margin-right: 100px;
    }

    .station_exist {
        float: right;
    }

    table.list_station_random {
        border: 1px solid gray;
        width: 70%;
        float: right;
        margin-bottom: 25px;
        margin-top: -33px;
    }


</style>
<script language="JavaScript" type="text/javascript"
        src="<?php echo base_url(); ?>application/themes/bootstrap/js/start_game.js"></script>

<div id="content-header">
    <h1>Start a Game</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <!--<a href="javascript:" title="Go to Home" class="tip-bottom" onclick="return goBack();"><i class=""></i> Game parameters</a>-->


</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
                    <h5>Station HQ</h5>

                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Stations</label>

                            <div class="controls">
                                <select name="cbStation" id="cbStation" style="width: 300px;"
                                        onchange="station_change(this);">
                                    <?php foreach ($allStation as $item): ?>
                                        <option value="<?php echo $item->Id ?>" <?php echo $game_hq != null  && $game_hq->station_id == $item->Id ? "selected" :"" ?> ><?php echo $item->Name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Challenges</label>

                            <div class="controls">
                                <select name="cbChallenge" id="cbChallenge" style="width: 300px;" onchange="save_game_hq()">

                                </select>
                            </div>
                        </div>
                        <!--<div class="form-actions">
                            <input type="button" class="btn btn-primary" value="Save station HQ" id="btnSaveStationHQ"
                                   onclick="save_game_hq(true);"/>
                        </div>-->
                    </form>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>Stations Max <?php echo $max_station; ?></h5>
                </div>
                <div class="widget-content nopadding">
                    <table id="game_station" class="table table-bordered table-striped table-hover">
                        <tbody>
                        <?php if (count($random_station) == 0) echo "Empty station!"; ?>
                        <?php foreach ($random_station as $item): ?>
                            <tr>
                                <td style="text-align: left;"><?php echo $item->Name; ?></td>
                                <td style="text-align: right;">
                                    <input type="button" value="remove"
                                           station_id="<?php echo $item->StationId; ?>"
                                           name="btnRemove"
                                           class="btn btn-danger btn-mini remove_button"/>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions">
                    <a href="#" id="open-modal" class="btn btn-primary">Add exist station</a>
                </div>
                <div class="form-actions">

                    <input type="button" value="< Back to Game Parameters"
                           name="btnBack"
                           class="btn btn-primary" onclick="return goBack();"/>


                    <input type="button" value=" Define Teams > "
                           name="btnDefine"
                           class="btn btn-primary" onclick="go_to_define_team()"/>
                    <input type="hidden" id="txt_no_of_team" name="txt_no_of_team" value="<?php echo $no_of_team; ?>"/>
                    <input type="hidden" id="txt_max_station" name="txt_max_station" value="<?php echo $max_station; ?>"/>
                    <input type="hidden" id="txtId" name="txtId" value="<?php echo $game_id; ?>"/>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#start_game").addClass("active");
        $("#game_station").addClass("active");

        $("#cbStation").change();
        //save_game_hq(false);
    });

    function save_game_hq(){
        var game_id = $("#txtId").val();
        var station_id = $("#cbStation").val();
        var challenge_id = $("#cbChallenge").val();
        var data_string1 = 'game_id=' + game_id + '&station_id=' + station_id + '&challenge_id=' + challenge_id;
        $.ajax({
            type: "POST",
            url: BASE_URI + "startgame/insert_game_hq",
            data: data_string1,
            success: function (data_form) {
                console.log(data_form);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });
    }

    function check_exist_game_hq(){
        var game_id = $("#txtId").val();
        var data_string = 'game_id=' + game_id;
        $.ajax({
            type: "POST",
            url: BASE_URI + "startgame/check_exist_game_hq",
            data: data_string,
            success: function (data_form) {
                console.log(data_form);
                if (data_form) {

                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });
    }

    function station_change(item) {
        var game_id = $("#txtId").val();
        var station_id = $(item).val();
        var data_string = 'game_id=' + game_id +'&station_id=' + station_id;
        $.ajax({
            type: "POST",
            url: BASE_URI + "startgame/get_challenge_by_station",
            data: data_string,
            success: function (data_form) {
                $("#cbChallenge").html(data_form);
                $('select').select2();
                var game_id = $("#txtId").val();
                var challenge_id = $("#cbChallenge").val();
                var data_string1 = 'game_id=' + game_id + '&station_id=' + station_id + '&challenge_id=' + challenge_id;
                $.ajax({
                    type: "POST",
                    url: BASE_URI + "startgame/insert_game_hq",
                    data: data_string1,
                    success: function (data_form) {
                        console.log(data_form);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                    }
                });
                // show hide exist station vs station hq
                $("#modal-dialog table tr td input").each(function () {
                    var id = $(this).attr("station_id");
                    if (id == station_id) {
                        $(this).parent().parent().hide();
                    }else{
                        $(this).parent().parent().show();
                    }
                });

                //remove station game exist
                $("table#game_station tr td input").each(function(){
                    var id = $(this).attr("station_id");
                    if (id == station_id) {
                        RemoveStation(id);
                        $(this).parent().parent().remove();
                    }
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });

    }

</script>


<div id="modal-dialog" title="Available Stations">
    <div class="widget-box">
        <div class="widget-title">
								<span class="icon">
									<i class="icon-th"></i>
								</span>
            <h5 class="status"></h5>

        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered table-striped table-hover data-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Add</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allStation as $item): ?>
                    <tr>
                        <td><?php echo $item->Name; ?></td>
                        <td>
                            <input type="button" value="add"
                                   station_id="<?php echo $item->Id; ?>"
                                   name="btnAdd"
                                   class="btn btn-primary btn-mini" onclick="return AddStation(this)"/>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>