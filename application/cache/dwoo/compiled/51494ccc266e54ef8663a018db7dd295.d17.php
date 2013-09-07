<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Top friend -->
<div id="top-friend">
    <ul>
        <li>
            <a href="#">
                <img alt="friend" src="http://localhost/socialnetwork/upload/images/avatar/tieudiem.png"/>
            </a>
        </li>
        <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

            <h4>A PHP Error was encountered</h4>

            <p>Severity: Notice</p>

            <p>Message: Undefined variable: friends</p>

            <p>Filename: partials/top_friend.html</p>

            <p>Line Number: 9</p>

        </div>
        <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

            <h4>A PHP Error was encountered</h4>

            <p>Severity: Warning</p>

            <p>Message: Invalid argument supplied for foreach()</p>

            <p>Filename: partials/top_friend.html</p>

            <p>Line Number: 9</p>

        </div>
    </ul>
</div>
<div class="clear"></div>
<div
    style="height: 13px; width: 99.6%; border-top: solid 1px #cccccc; border-left: solid 1px #cccccc; border-bottom: solid 1px #cccccc; float: right; margin: 2px 0 2px 0;">

</div>
<!-- /Top friend --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>