<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id="menu_left">
    <div class="node">
        <div class="leaf active" id="user">
            <a href="http://localhost/spanq/user">Users</a>
        </div>
        <div class="leaf_node">
            <span>
            <a href="http://localhost/spanq/user/adduser">New User</a>
                </span>
        </div>
    </div>
    <div class="node">
        <div class="leaf">
            <a href="http://localhost/spanq/group">Groups</a>
        </div>
        <div class="leaf_node">
            <span class="active">
                <a href="http://localhost/spanq/group/addgroup">New Group</a>
            </span>
            <span>
                <a href="http://localhost/spanq/group/addgroup">New Group</a>
            </span>

        </div>
    </div>
</div>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>