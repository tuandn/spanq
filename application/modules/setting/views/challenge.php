<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */
$e_base_point = array(
    'id' => "txtEBasePoint",
    'name' => 'txtEBasePoint',
    'value' => $challenge_d->E_BasePoint
);

$e_pen = array(
    'id' => "txtEpen",
    'name' => 'txtEpen',
    'value' => $challenge_d->E_PenaltyPerFail
);

$e_max_no = array(
    'id' => "txtEMaxNo",
    'name' => 'txtEMaxNo',
    'value' => $challenge_d->E_MaxNo
);
$d_base_point = array(
    'id' => "txtDBasePoint",
    'name' => 'txtDBasePoint',
    'value' => $challenge_d->D_BasePoint
);

$d_pen = array(
    'id' => "txtDpen",
    'name' => 'txtDpen',
    'value' => $challenge_d->D_PenaltyPerFail
);

$d_max_no = array(
    'id' => "txtDMaxNo",
    'name' => 'txtDMaxNo',
    'value' => $challenge_d->D_MaxNo
);

?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#setting").addClass("active");
        $("#setting_challenge").addClass("active");
    });
</script>
<div id="content-header">
    <h1>Challenge settings</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <!--<a href="<?php /*echo base_url(); */?>setting/murder" class="current">Games settings</a>-->
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>Challenge settings</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="setting/save_challenge" name="challenge_setting_validate"
                          id="challenge_setting_validate" novalidate="novalidate">
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
                        <div class="form-actions">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>