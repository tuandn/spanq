<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Banner -->
<div id="banner">
    <div id="banner-left" style="float: left; width: 50%; height: 100%;">
        <div id="logo" style="width:60%; margin: auto; margin-top: 40px;">
            <a style="text-decoration: none;" href="http://localhost/socialnetwork/"><h1
                    style="font-size: 18pt; font-family:fantasy; color: green; font-weight: bold; text-transform: uppercase;">
                    Social Network</h1></a>

            <p style="color: navy; font-size: 12pt;">Kết bạn trực tuyến</p>
        </div>
    </div>

    <div id="banner-right">

    </div>
</div>
<div class="clear"></div>
<!-- /Banner --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>