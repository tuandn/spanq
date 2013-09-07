<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Begin meta tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="author" content="spanq"/>
<meta name="copyright" content="spanq"/>
<meta name="distribution" content="global"/>
<meta name="resource-type" content="document"/>
<link rel="stylesheet" href="http://localhost/spanq/application/themes/default/css/style.css" />
    <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>