<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Menu -->
<div id="menu">
    <ul>
        <li>
            <a href="#"><span>Link 3</span></a>
        </li>
        <li>
            <a href="#"><span>Link 3</span></a>
        </li>
        <li>
            <a href="#"><span>Link 3</span></a>
        </li>
        <li>
            <a href="#"><span>Link 3</span></a>
        </li>
        <li>
            <a href="#"><span>Link 3</span></a>
        </li>
        <li>
            <a href="#"><span>Link 3</span></a>
        </li>
    </ul>
</div>
<div class="clear"></div>
<!-- /Menu --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>