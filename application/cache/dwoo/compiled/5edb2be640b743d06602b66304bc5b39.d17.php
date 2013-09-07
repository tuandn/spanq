<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <div id="nav-email">
        <p>Nhập email để biết những bạn bè nào của bạn đã tham gia <a href="http://localhost/socialnetwork/">Social
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
                    <td><input id="btnContinue" type="submit" value="Tiếp tục" name="btnContinue"/></td>
                </tr>
            </table>
            <div style="height: auto; width: 98%; float: left; margin-left:15px; margin-top: 15px; margin-bottom: 5px;">
                <a href="#" style="margin-right: 15px;">
                    <img height="25" width="35" alt="gmail"
                         src="http://localhost/socialnetwork/application/themes/default/img/gmail_icon.png"/> </a>
                <a href="#">
                    <img height="25" width="35" alt="yahoo"
                         src="http://localhost/socialnetwork/application/themes/default/img/yahoo_icon.png"/> </a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div><?php /* end template body */
return $this->buffer . ob_get_clean();
?>