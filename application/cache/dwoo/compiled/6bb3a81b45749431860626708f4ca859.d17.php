<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id="logo">

</div>
<div id="head">
    <div id="login_status">
        <h2>Welcome, Administrator</h2>
        <a href="#">log out</a>
    </div>
    <div id="menu">
        <div id="nav">
            <ul>
                <li><a href="#">Activity</a></li>
                <li><a href="http://localhost/spanq/landmark">Locations & Challenges</a></li>
                <li><a href="http://localhost/spanq/user">Users & Groups</a></li>
                <li><a href="http://localhost/spanq/setting/checkin">System Settings</a></li>
            </ul>
        </div>
        <div id="start_game"><a href="#">Start a Game</a></div>
    </div>
</div>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>