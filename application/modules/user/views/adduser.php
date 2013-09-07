<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/6/13
 * Time: 11:47 AM
 * To change this template use File | Settings | File Templates.
 */
$name = array(
    'id' => "txtName",
    'name' => 'txtName',
);

$email = array(
    'id' => "txtEmail",
    'name' => 'txtEmail',
);

$phone = array(
    'id' => "txtPhone",
    'name' => 'txtPhone',
);

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
                    <h5>Add new</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="user/insert" name="user_validate"
                          id="user_validate" novalidate="novalidate">
                        <div class="control-group">
                            <label class="control-label">Name</label>

                            <div class="controls">
                                <?php echo form_input($name) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Email</label>

                            <div class="controls">
                                <?php echo form_input($email) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Phone</label>

                            <div class="controls">
                                <?php echo form_input($phone) ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Role</label>

                            <div class="controls">
                                <select name="cbRole" style="width: 200px;">
                                    <?php foreach ($listRole as $item): ?>
                                        <option value="<?php echo $item->Id ?>"><?php echo $item->role_name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Group</label>

                            <div class="controls">
                                <select name="cbGroup" style="width: 200px;">
                                    <?php foreach ($listGroup as $item): ?>
                                        <option value="<?php echo $item->Id ?>"><?php echo $item->Name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>

                            <div class="controls">
                                <a href="<?php echo base_url(); ?>group/addgroup" class="btn btn-primary">New Group</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password</label>

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


