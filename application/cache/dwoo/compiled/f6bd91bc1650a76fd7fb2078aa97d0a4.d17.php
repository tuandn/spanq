<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Banner -->
<div id="banner">

</div>
<div class="clear"></div>
<!-- /Banner --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>