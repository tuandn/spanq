<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <ul id="root">
        <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

            <h4>A PHP Error was encountered</h4>

            <p>Severity: Notice</p>

            <p>Message: Undefined variable: left_type</p>

            <p>Filename: partials/left.html</p>

            <p>Line Number: 3</p>

        </div>
        <div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

            <h4>A PHP Error was encountered</h4>

            <p>Severity: Notice</p>

            <p>Message: Undefined variable: left_type</p>

            <p>Filename: partials/left.html</p>

            <p>Line Number: 14</p>

        </div>
    </ul><?php /* end template body */
return $this->buffer . ob_get_clean();
?>