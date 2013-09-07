<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><ul id="root">
    <li><a href="http://localhost/spanq/setting/challenge">Challenge Settings</a>
    </li>
    <li><a href="http://localhost/spanq/setting/checkin">Checkin Settings</a>
    </li>
</ul><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>