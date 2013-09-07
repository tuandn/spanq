<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */
$name = array(
    'id' => "txtName",
    'name' => 'txtName',
    'size' => 100,
    'value' => $landmark->Name
);

$lat = array(
    'id' => "txtLat",
    'name' => 'txtLat',
    'size' => 50,
    'value' => $landmark->LocationLat
);

$long = array(
    'id' => "txtLong",
    'name' => 'txtLong',
    'size' => 50,
    'value' => $landmark->LocationLong
);

?>

    <div id="content-header">
        <h1>Landmarks</h1>
    </div>
    <div id="breadcrumb">
        <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="<?php echo base_url(); ?>landmark" class="current">Landmarks</a>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                        <h5><?php echo $landmark->Name; ?>/h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="landmark/update" name="landmark_validate"
                              id="landmark_validate" novalidate="novalidate">
                            <div class="control-group">
                                <label class="control-label">Name</label>

                                <div class="controls">
                                    <?php echo form_input($name) ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Area</label>

                                <div class="controls">
                                    <?php echo $listArea ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address</label>

                                <div class="controls">
                                    <textarea rows="3" style="width: 100%" name="txtAddress" id="txtAddress"
                                              onblur="return set_location_by_address(this)"><?php echo $landmark->Address; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Location lat</label>

                                <div class="controls">
                                    <?php echo form_input($lat) ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Location long</label>

                                <div class="controls">
                                    <?php echo form_input($long) ?>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Save" class="btn btn-primary">
                                <input type="hidden" id="txtId" name="txtId" value="<?php echo $landmark->Id; ?>"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $("#landmark").addClass("active");
        });
    </script>
