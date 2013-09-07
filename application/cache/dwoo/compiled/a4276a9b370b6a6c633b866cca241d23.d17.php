<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <?php echo $this->scope["template"]["partials"]["metadata"]; ?>

    <?php echo $this->scope["template"]["metadata"]; ?>

    <title>home <?php echo $this->scope["template"]["title"]; ?></title>

    <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

        <h4>A PHP Error was encountered</h4>

        <p>Severity: Warning</p>

        <p>Message: Missing argument 1 for Asset::get_filepath_js(), called in
            D:\PHP\socialnetwork\application\themes\default\views\layouts\home.html on line 7 and defined</p>

        <p>Filename: libraries/Asset.php</p>

        <p>Line Number: 718</p>

    </div>
    <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

        <h4>A PHP Error was encountered</h4>

        <p>Severity: Notice</p>

        <p>Message: Undefined variable: filename</p>

        <p>Filename: libraries/Asset.php</p>

        <p>Line Number: 720</p>

    </div>
    application/themes/default/js/
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/test.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-1.8.0.min.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-ui-1.8.23.custom.min.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.ui.datepicker-vi.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.corner.js"></script>
</head>
<body>
<div id="container">

    <!-- Banner -->
    <?php echo $this->scope["template"]["partials"]["banner"]; ?>

    <!-- /Banner -->

    <!-- Menu -->
    <?php echo $this->scope["template"]["partials"]["menu"]; ?>

    <!-- /Menu -->

    <!-- Main -->
    <div id="main">

        <!-- Main Left -->
        <?php echo $this->scope["template"]["body"]; ?>

        <!-- /Main Left -->

        <!-- Main Right -->
        <?php echo $this->scope["template"]["partials"]["main_right"]; ?>

        <!-- /Main Right -->

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!-- /Main -->

    <!-- Footer -->
    <?php echo $this->scope["template"]["partials"]["footer"]; ?>

    <!-- /Footer -->

</div>
</body>
</html><?php /* end template body */
return $this->buffer . ob_get_clean();
?>