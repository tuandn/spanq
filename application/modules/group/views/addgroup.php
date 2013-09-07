<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/11/13
 * Time: 10:34 PM
 * To change this template use File | Settings | File Templates.
 */
$name = array(
    'id' => "txtName",
    'name' => 'txtName',
    'size' => 100,
);

$contact = array(
    'id' => "txtContact",
    'name' => 'txtContact',
    'size' => 100,
);

?>

    <div id="content-header">
        <h1>Groups</h1>
    </div>
    <div id="breadcrumb">
        <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="<?php echo base_url(); ?>group" class="current">Groups</a>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                        <h5>Add new</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="group/insert" name="group_validate"
                              id="group_validate" novalidate="novalidate">
                            <div class="control-group">
                                <label class="control-label">Name</label>

                                <div class="controls">
                                    <?php echo form_input($name) ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contact</label>

                                <div class="controls">
                                    <?php echo form_input($contact) ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Area</label>

                                <div class="controls">
                                    <?php echo $listArea ?>
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


    <script type="text/javascript">
        $(document).ready(function () {
            $("#group").addClass("active");
            $("#add_group").addClass("active");
        });
    </script>

