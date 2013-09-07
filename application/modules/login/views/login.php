<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 6/6/13
 * Time: 4:54 PM
 * To change this template use File | Settings | File Templates.
 */
$email = array(
    'id' => "txtEmail",
    'name' => 'txtEmail',
    'size' => 100,
    'value' => set_value('txtEmail'),
    'placeholder' => "Email"
);

$password = array(
    'id' => "txtPassword",
    'name' => 'txtPassword',
    'size' => 100,
    'type' => 'password',
    'placeholder' => "Password"
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spanq HQ</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/themes/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>application/themes/bootstrap/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/themes/bootstrap/css/unicorn.login.css"/>
</head>
<body>
<div id="logo">
    <!--<img src="img/logo.png" alt=""/>-->
</div>
<div id="loginbox">
    <?php echo form_open('login/process'); ?>
    <p>Enter email and password to continue.</p>

    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <?php echo form_input($email) ?>
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span>
                <?php echo form_input($password) ?>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <span style="color:red; font-size: 13px; "><?php echo $msg ?></span>
        <span class="pull-right"><input type="submit" class="btn btn-inverse" value="Login"/></span>
    </div>
    <?php echo form_close(); ?>

</div>

<script src="<?php echo base_url(); ?>application/themes/bootstrap/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>application/themes/bootstrap/js/unicorn.login.js"></script>
</body>
</html>
