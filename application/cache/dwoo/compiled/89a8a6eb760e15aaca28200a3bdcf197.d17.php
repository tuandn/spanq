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
        <div class="info">
            Nam, 21 Tuoi
        </div>
        <div class="clear"></div>
        <div class="info">
            Ha Noi
        </div>
        <div class="clear"></div>
        <div class="info">
            Doc than
        </div>
        <div class="clear"></div>


        <div id="nav-menu-left">
            <ul>
                <li><a href="#">>> Menu 1</a></li>
                <li><a href="#">>> Menu 1</a></li>
                <li><a href="#">>> Menu 1</a></li>
                <li><a href="#">>> Menu 1</a></li>
                <li><a href="#">>> Menu 1</a></li>
            </ul>
        </div>

        <div class="clear"></div>
    </div>


    <div class="clear"></div>
</div>
<!-- /Main Right --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>