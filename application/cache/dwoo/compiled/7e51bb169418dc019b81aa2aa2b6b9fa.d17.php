<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->scope["template"]["partials"]["metadata"];?>

    <?php echo $this->scope["template"]["metadata"];?>

    <title><?php echo $this->scope["template"]["title"];?></title>
    <!--<link rel="stylesheet" href="http://localhost/spanq/application/themes/default/css/reset.css"/>-->
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/spanq/application/themes/default/js/jquery-1.10.1.min.js"></script>
    <script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/spanq/application/themes/default/js/common.js"></script>
</head>
<body>
<div id="container">
    <div id="top">
        <?php echo $this->scope["template"]["partials"]["header"];?>

    </div>
    <div id="main">
        <div id="left">
            <?php echo $this->scope["template"]["partials"]["left"];?>

        </div>
        <div id="content">
            <?php echo $this->scope["template"]["body"];?>

        </div>
    </div>
    <div id="footer">
    </div>
</div>
</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>