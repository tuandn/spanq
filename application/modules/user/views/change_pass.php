<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/6/13
 * Time: 11:47 AM
 * To change this template use File | Settings | File Templates.
 */

$password = array(
    'id' => "txtPassword",
    'name' => 'txtPassword',
    'type' => 'password'
);

$confirm_password = array(
    'id' => "txtConfirm",
    'name' => 'txtConfirm',
    'type' => 'password'
);

?>

<div id="content-header">
    <h1>Users</h1>
</div>
<div id="breadcrumb">
    <a href="<?php echo base_url(); ?>activity" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
    <a href="<?php echo base_url(); ?>user" class="current">Users</a>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                    <h5>Change password</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="user/update_pass" name="change_pass_validate"
                          id="change_pass_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">New password</label>

                            <div class="controls">
                                <?php echo form_input($password) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Confirm password</label>

                            <div class="controls">
                                <?php echo form_input($confirm_password) ?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <input type="hidden" id="txtId" name="txtId" value="<?php echo $user->Id; ?>"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $("#user").addClass("active");
        $("#add_user").addClass("active");
    });
</script>


