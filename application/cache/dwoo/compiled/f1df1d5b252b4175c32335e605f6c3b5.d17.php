<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Main Right -->
<div id="main-right">

    <div class="clear"></div>
</div>
<!-- /Main Right --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>