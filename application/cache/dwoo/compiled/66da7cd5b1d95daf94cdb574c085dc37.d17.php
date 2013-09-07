<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><ul id="root">
    <li><a href="">1.Game Parameters</a></li>
    <li><a href="">2.Stations</a> </li>
    <li><a href="">3.Teams</a> </li>
</ul><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>