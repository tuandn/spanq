<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><ul id="root">
    <li><a href="javascript:">1.Game Parameters</a></li>
    <li><a href="javascript:">2.Stations</a> </li>
    <li><a href="javascript:">3.Teams</a> </li>
</ul><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>