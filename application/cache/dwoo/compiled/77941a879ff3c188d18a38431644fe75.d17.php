<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Menu -->
<div id="menu">

</div>
<div class="clear"></div>
<!-- /Menu --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>