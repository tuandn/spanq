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
            Nam, 21 Tuổi
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
                <li><a href="#">Hòm thư</a></li>
                <li><a href="#">Album ảnh</a></li>
                <li><a href="#">Video</a></li>
                <li><a href="#">Viết blog</a></li>
                <li><a href="#">Tài khoản</a></li>
                <li><a href="#">Bạn bè</a></li>
            </ul>
        </div>
        <div class="clear"></div>

        <div id="nav-gifts">
            <span style="line-height: 30px; margin-left: 30px;">Qua tang(8)</span>
            <span class="friend">3</span>
            <span class="dolar">3</span>
        </div>
        <div class="clear"></div>
    </div>


    <div class="clear"></div>
</div>
<!-- /Main Right --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>