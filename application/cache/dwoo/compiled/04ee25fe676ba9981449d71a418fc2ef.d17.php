<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>    <!-- Begin meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="Duyliempro"/>
    <meta name="copyright" content="duyliempro"/>
    <meta name="distribution" content="global"/>
    <meta name="resource-type" content="document"/>
    <link rel="stylesheet" href="http://localhost/socialnetwork/application/themes/default/css/style.css"/>
<?php /* end template body */
return $this->buffer . ob_get_clean();
?>