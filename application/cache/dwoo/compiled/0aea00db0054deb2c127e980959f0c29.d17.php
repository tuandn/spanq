<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Banner -->
<div id="banner">
    <div id="banner-left">
        <div id="logo">
            <a href="http://localhost/socialnetwork/"><h1></h1></a>

            <p>Kết bạn trực tuyến</p>
        </div>
    </div>

    <div id="banner-right">
        <div id="user">
            <p style="">Xin chao, <a href="#">mrcong</a> !</p>
        </div>
        <div class="clear"></div>
        <div id="info">
            <span>3</span>
            <span class="friend">3</span>
            <span class="dolar">3</span>
            <a href="http://localhost/socialnetwork/user/logout"
               onclick="return confirm('Bạn có chắc muốn đăng xuất không ?');">Thoat</a>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<!-- /Banner --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>