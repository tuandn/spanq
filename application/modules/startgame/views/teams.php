<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 7/2/13
 * Time: 10:34 PM
 * To change this template use File | Settings | File Templates.
 */
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
                    <h5>Teams</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="startgame/game_summary">
                        <?php  for ($i = 1; $i <= $no_of_teams; $i++) {
                            $access_code = mt_rand(100000000, 999999999);?>
                            <div class="control-group">
                                <label class="control-label"><?php echo "Team " . $i . " Name"; ?></label>

                                <div class="controls">
                                    <?php echo "<input type='text' id='txtTeamName" . $i . "' name='txtTeamName" . $i . "' />"; ?>
                                    <?php echo "<span id=\"status-team-" . $i . "\" class=\"error-inline\"></span>"; ?>
                                    <?php echo "<input type='hidden' value='" . $access_code . "' name='access_code" . $i . "'/>"; ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="form-actions">
                            <input type="hidden" id="txt_game_id" name="txt_game_id" value="<?php echo $game_id; ?>"/>
                            <input type="hidden" id="txt_no_of_team" name="txt_no_of_team"
                                   value="<?php echo $no_of_teams; ?>"/>
                            <input type="button" value="< Back to Station"
                                   name="btnBack"
                                   class="btn btn-primary" onclick="goBack_Station()"/>
                            <input type="submit" value=" Start Game! "
                                   name="btnStartGame"
                                   class="btn btn-primary" onclick="return validate_start_game();"/>

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
        $("#game_team").addClass("active");
    });
</script>