<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */
$no_invalid = array(
    'id' => "txtNoInvalid",
    'name' => 'txtNoInvalid',
    'value' => $checkin_d->NoInvalid
);

$pen_invalid = array(
    'id' => "txtPenInvalid",
    'name' => 'txtPenInvalid',
    'value' => $checkin_d->PenaltyPerInvalid
);

$max_no = array(
    'id' => "txtMaxNoPen",
    'name' => 'txtMaxNoPen',
    'value' => $checkin_d->MaxNo
);
$max_point = array(
    'id' => "txtMaxPoint",
    'name' => 'txtMaxPoint',
    'value' => $checkin_d->MaxPoint
);
/*$max_point_mini = array(
    'id' => "txtMaxPointMini",
    'name' => 'txtMaxPointMini',
    'value' => $checkin_d->Maxpoint_GameMini
);*/

?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#setting").addClass("active");
        $("#setting_checkin").addClass("active");
    });
</script>
<div id="content-header">
    <h1>Checkin Settings</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
<!--    <a href="--><?php //echo base_url(); ?><!--setting/murder" class="current">Games settings</a>-->
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>Checkin Settings</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="setting/save_checkin"
                          name="checkin_setting_validate"
                          id="checkin_setting_validate" novalidate="novalidate">
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
                            <label class="control-label">Max Point</label>

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
                        <div class="form-actions">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>