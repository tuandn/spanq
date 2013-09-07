<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <?php echo $this->scope["template"]["partials"]["metadata"]; ?>

    <?php echo $this->scope["template"]["metadata"]; ?>

    <title><?php echo $this->scope["template"]["title"]; ?></title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.23/themes/base/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css"
          media="all"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js"
            type="text/javascript"></script>
    <script src="http://jquery-ui.googlecode.com/svn/tags/latest/ui/minified/i18n/jquery-ui-i18n.min.js"
            type="text/javascript"></script>
    <script src="/js/demos.js" type="text/javascript"></script>
    <script src="/themeroller/themeswitchertool/" type="text/javascript"></script>

    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-1.8.0.min.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery-ui-1.8.23.custom.min.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.ui.datepicker-vi.js"></script>
    <script language="JavaScript" type="text/javascript"
            src="http://localhost/socialnetwork/application/themes/default/js/jquery/jquery.corner.js"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            //alert(BASE_URL);
            $("#nav-frame-email").corner("6px");
            $("#btnContinue").corner("3px");

        });

        function editQuestion(id) {
            alert('question' + id);
        }

        //bat dau
        $(function () {
            $("#dialog:ui-dialog").dialog("destroy");

            $("#dialog-form").dialog({
                autoOpen: false,
                height: 300,
                width: 350,
                modal: true,
                buttons: {
                    "Create an account": function () {
                    },
                    Cancel: function () {
                        $(this).dialog("close");
                    }
                },
                close: function () {
                    allFields.val("").removeClass("ui-state-error");
                }
            });

            $("#create-question")
                .button()
                .click(function () {
                    $("#dialog-form").dialog("open");
                });
        });

    </script>
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
        <!-- Top friend -->
        <?php echo $this->scope["template"]["partials"]["top_friend"]; ?>

        <!-- /Top friend -->

        <!-- Main Left -->
        <?php echo $this->scope["template"]["body"]; ?>

        <!-- /Main Left -->

        <!-- Main Right -->
        <div id="main-right">
            <?php echo $this->scope["template"]["partials"]["main_right"]; ?>

            <?php echo $this->scope["template"]["partials"]["main_right_bottom"]; ?>

        </div>
        <div class="clear"></div>
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