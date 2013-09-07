<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->scope["template"]["partials"]["metadata"]; ?>

    <?php echo $this->scope["template"]["metadata"]; ?>

    <title><?php echo $this->scope["template"]["title"]; ?></title>
    <!--  
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script language="JavaScript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="http://malsup.github.com/jquery.corner.js"></script>
    -->
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
            //alert("document ready occurred!");
            $("#main").corner("20px");
            $("#frameMessage,#titleMess").corner("10px");

            $.datepicker.setDefaults($.datepicker.regional[ "vi" ]);
            $("#birthday").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1980:2010'
            });

            //$('#getdata').click(function(){
            //$.ajax({
            //        url: "http://localhost/socialnetwork/profiles/get_all_users",
            //        type:'POST',
            //        dataType: 'json',
            //        success: function(output_string){
            //                $("#result_table").append(output_string);
            //            } // End of success function of ajax form
            //        }); // End of ajax call
            //alert("khong hieu loi");
            //});
        });
    </script>
</head>
<body>
<div id="container">
    <?php echo $this->scope["template"]["partials"]["header"]; ?>

    <?php echo $this->scope["template"]["body"]; ?>

    <?php echo $this->scope["template"]["partials"]["footer"]; ?>

</div>
</body>
</html><?php /* end template body */
return $this->buffer . ob_get_clean();
?>