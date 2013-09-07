<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Footer -->
<div id="footer">

</div>
<div class="clear"></div>
<!-- /Footer -->
<div class="clear"></div><?php /* end template body */
return $this->buffer . ob_get_clean();
?>