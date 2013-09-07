<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id="logo">

</div>
<div id="head">
    <div id="login_status">
        <h2>Welcome, Adminnistrator</h2>
        <a href="http://localhost/spanq/login/logout">log out</a>
    </div>
    <div id="menu">
        <div id="nav">
            <ul>
                
                <li><a href="http://localhost/spanq/area">Locations & Challenges</a></li>

                            </ul>
        </div>
            </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>