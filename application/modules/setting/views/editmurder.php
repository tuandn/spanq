<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/21/13
 * Time: 7:04 PM
 * To change this template use File | Settings | File Templates.
 */
$type = array(
    'id' => "txtType",
    'name' => 'txtType',
    'value' => $murder->Type

);

$value = array(
    'id' => "txtValue",
    'name' => 'txtValue',
    'value' => $murder->Value

);

?>

    <div id="content-header">
        <h1>Edit Murder mystery</h1>
    </div>
    <div id="breadcrumb">
        <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="<?php echo base_url(); ?>setting/murder" class="current">Murder mystery</a>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                        <h5><?php echo $murder->Type; ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="setting/update_murder" name="murder_validate"
                              id="murder_validate" novalidate="novalidate">
                            <div class="control-group">
                                <label class="control-label">Type</label>

                                <div class="controls">
                                    <?php echo form_input($type) ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Value</label>

                                <div class="controls">
                                    <?php echo form_input($value) ?>
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" value="Save" class="btn btn-primary">
                                <input type="hidden" id="txtId" name="txtId" value="<?php echo $murder->Id; ?>"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#setting").addClass("active");
        });
    </script>