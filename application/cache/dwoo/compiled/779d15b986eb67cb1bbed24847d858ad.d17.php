<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <div id="banner">
        <div id="banner-left">
            <div id="logo">
                <a style="text-decoration: none;" href="http://localhost/socialnetwork/"><h1>Social Network</h1></a>

                <p>Kết bạn trực tuyến</p>
            </div>
        </div>
        <div id="banner-right">

            <!-- thay doi ngon ngu -->
            <!--
            <div id="banner-language" >
                <a href="vn/User/account">
                    <img src="public/us/img/vietnam.png" width="20px" height="15px"/>
                </a>
                <a href="en/User/account">
                    <img src="public/us/img/english.png" width="20px" height="15px"/>
                </a>
            </div>
            --->
            <!-- /thay doi ngon ngu -->

        </div>
    </div>
    <div class="clear"></div><?php /* end template body */
return $this->buffer . ob_get_clean();
?>