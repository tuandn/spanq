<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <ul id="root">
        <li><a href="http://localhost/spanq/user">Users</a>
            <ul>
                <li>
                    <a href="http://localhost/spanq/user/adduser">New User</a>
                </li>
            </ul>
        </li>
        <li><a href="http://localhost/spanq/group">Groups</a>
            <ul>
                <li>
                    <a href="http://localhost/spanq/group/addgroup">New Group</a>
                </li>
            </ul>
        </li>
    </ul><?php /* end template body */
return $this->buffer . ob_get_clean();
?>