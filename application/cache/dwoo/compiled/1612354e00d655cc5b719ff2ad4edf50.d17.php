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
            <span><a href="#">Quà tặng(8)</a></span>
            <span><a href="#">Đánh dấu(8)</a></span>
            <span><a href="#">Chặn(8)</a></span>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div id="nav-email">
        <p>Nhap email de biet nhung ban be nao cua ban da tham gia <a href="http://localhost/socialnetwork/">Social
                Network</a></p>

        <div class="clear"></div>
        <div id="nav-frame-email">
            <table border="0" style="margin: auto; height: auto; width: 90%; margin-top: 25px;">
                <tr style="height: 30px;">
                    <th colspan="2" style="font-weight: bold; font-size: 18pt;" align="left">Gmail</th>
                </tr>
                <tr style="height: 35px;">
                    <td>Email Gmail</td>
                    <td><input type="text" id="txtEmail" name="txtEmail" style="width: 180px; height: 21px;"/></td>
                </tr>
                <tr style="height: 35px;">
                    <td>Password Gmail</td>
                    <td><input type="password" id="txtPassword" name="txtPassword" style="width: 180px; height: 21px;"/>
                    </td>
                </tr>
                <tr style="height: 35px;">
                    <td></td>
                    <td><input id="btnContinue" type="submit" value="Tiep tuc" name="btnContinue"/></td>
                </tr>
            </table>
            <div style="height: 60px; width: 100%; background-color: purple; margin-top: 15px; margin-bottom: 5px;">

            </div>
        </div>
        <div class="clear"></div>
    </div>


    <div class="clear"></div>

</div>
<div class="clear"></div>
<!-- /Main Right --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>