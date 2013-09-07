<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Main Right -->
<div id="main-right">
    <div id="nav-avatar">
        <img alt="avartar" src="http://localhost/socialnetwork/upload/images/avatar/demo.jpg">
    </div>
    <div id="nav-left">
        <div id="nickname">
            <p>mrcong</p>
        </div>
        <div class="clear"></div>
        <div id="gender">
            <p>Nam, 21 tuoi</p>
        </div>


        <div class="clear"></div>
    </div>


    <div class="clear"></div>
</div>
<!-- /Main Right --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>