<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Menu -->
<div id="menu">
    <ul>
        <li>
            <a href="http://localhost/socialnetwork/">
                <span>Trang chủ</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span>Trang của tôi</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span>Tìm kiếm bạn bè</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span>Shop</span>
            </a>
        </li>
    </ul>
</div>
<div class="clear"></div>
<!-- /Menu --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>