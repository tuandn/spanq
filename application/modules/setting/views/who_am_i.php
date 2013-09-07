<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */

$max_point_mini = array(
    'id' => "txtMaxPointMini",
    'name' => 'txtMaxPointMini',
    'value' => $who_am_i->MaxPoint
);

?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#setting").addClass("active");
        $("#setting_who_am_i").addClass("active");
    });
</script>
<div id="content-header">
    <h1>Who am i Settings</h1>
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
                    <h5>Who am i Settings</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="setting/save_who_am_i"
                          name="who_am_i_setting_validate"
                          id="who_am_i_setting_validate" novalidate="novalidate">

                        <div class="control-group">
                            <label class="control-label">Max Point for game mini</label>

                            <div class="controls">
                                <?php echo form_input($max_point_mini) ?>
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