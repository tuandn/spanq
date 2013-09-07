<?php
?>

<script language="JavaScript" type="text/javascript"
        src="<?php echo base_url(); ?>application/themes/bootstrap/js/start_game.js"></script>

<div id="content-header">
    <h1>Start a Game</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
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
                    <form class="form-horizontal" method="post" action="startgame/final_standing">
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
                            <label class="control-label">No of Stations</label>

                            <div class="controls">
                                <input type="text" class="large-text" id="txtStations" name="txtStations"
                                       value="<?php echo $no_of_station; ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">No of Teams</label>

                            <div class="controls">
                                <input type="text" class="large-text" id="txtTeams" name="txtTeams"
                                       value="<?php echo $no_of_team; ?>"/>
                            </div>
                        </div>
                        <?php $i = 1;
                        foreach ($arr_team as $item): ?>
                            <div class="control-group">
                                <label class="control-label">Access Code <?php echo $item->Name; ?></label>

                                <div class="controls">
                                    <?php echo "<input type='text' value='" . $item->AccessCode . "' name='txtAccessCode" . $i . "'/>"; ?>
                                </div>
                            </div>
                            <?php $i++; endforeach ?>
                        <div class="form-actions">
                            <input type="submit" value=" Print Access Codes "
                                   name="btnPrint"
                                   class="btn btn-primary" disabled="disabled"/>
                            <input type="hidden" id="txt_game_id" name="txt_game_id"
                                   value="<?php echo $game_summary->Id; ?>"/>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>