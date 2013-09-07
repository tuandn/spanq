<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- Main Right -->
<div id="main-right">
    <div style="position: absolute; margin-top:20px; margin-left:25px; height: 200px; width: 300px;">
        <img alt="avartar" style="border: solid 1px #cbdbea;"
             src="http://localhost/socialnetwork/upload/images/avatar/demo.jpg">
    </div>
    <div style="float: right; width: 70%; background-color: #bbddff; height: 700px; margin-bottom: 30px;">

    </div>


    <div class="clear"></div>
</div>
<!-- /Main Right --><?php /* end template body */
return $this->buffer . ob_get_clean();
?>