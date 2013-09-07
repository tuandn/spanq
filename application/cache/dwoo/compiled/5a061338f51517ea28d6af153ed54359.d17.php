<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Main Right -->
<div id="nav-avatar">
    <img alt="avartar"
         src="http://localhost/socialnetwork/upload/images/avatar/<?php echo $this->scope["user"]["avatar"]; ?>">
</div>
<div id="nav-left">

    <div id="nickname">
        <p><?php echo $this->scope["user"]["alias"]; ?></p>

    </div>
    <div class="clear"></div>
    <div class="info">
        <?php echo $this->scope["user"]["gender"]; ?>, <?php echo $this->scope["user"]["age"]; ?> Tuổi
    </div>
    <div class="clear"></div>
    <div class="info">
        <?php echo $this->scope["user"]["address"]; ?>

    </div>
    <div class="clear"></div>
    <div class="info">
        <?php echo $this->scope["user"]["marital_status"]; ?>

    </div>
    <div class="clear"></div>


    <div id="nav-menu-left">
        <ul>
            <li><a href="#">Hòm thư</a></li>
            <li><a href="#">Album ảnh</a></li>
            <li><a href="#">Video</a></li>
            <li><a href="#">Viết blog</a></li>
            <li><a href="http://localhost/socialnetwork/user/home/account">Tài khoản</a></li>
            <li><a href="#">Bạn bè</a></li>
        </ul>
    </div>
    <div class="clear"></div>

    <div id="nav-gifts">
        <span><a href="#">Quà tặng(<?php echo $this->scope["user"]["gifts"]; ?>)</a></span>
        <span><a href="#">Đánh dấu(<?php echo $this->scope["user"]["mark"]; ?>)</a></span>
        <span><a href="#">Chặn(<?php echo $this->scope["user"]["block"]; ?>)</a></span>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<!-- /Main Right --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>