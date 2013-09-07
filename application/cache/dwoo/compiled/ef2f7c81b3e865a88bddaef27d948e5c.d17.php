<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <div id="nav-email">
        <div style="width: 99.6%; margin-top: 2px; border: solid 1px #cccccc;">
            <iframe width="100%" height="315" src="http://www.youtube.com/embed/xhHufV9g4k4" frameborder="0"
                    allowfullscreen></iframe>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div><?php /* end template body */
return $this->buffer . ob_get_clean();
?>