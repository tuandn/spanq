<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Menu -->
<div id="menu">
    <ul>
        <li>
            <a href="#"><span>Trang chu</span></a>
        </li>
        <li>
            <a href="#"><span>Trang cua toi</span></a>
        </li>
        <li>
            <a href="#"><span>Tim kiem ban be</span></a>
        </li>
        <li>
            <a href="#"><span>Shop</span></a>
        </li>
    </ul>
</div>
<div class="clear"></div>
<!-- /Menu --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>