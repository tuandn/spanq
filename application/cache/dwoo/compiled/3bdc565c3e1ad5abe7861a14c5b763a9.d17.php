<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <ul id="root">
        <li class=""><a href="#">Users</a>
            <ul>
                <li class="">
                    <a href="#">New User</a>
                </li>
            </ul>
        </li>
        <li class=""><a href="#">Groups</a>
            <ul>
                <li class="">
                    <a href="#">New Group</a>
                </li>
            </ul>
        </li>
    </ul><?php /* end template body */
return $this->buffer . ob_get_clean();
?>