<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id="menu_left">
    <div class="node">
        <div class="leaf" id="user">
            <a href="http://localhost/spanq/user">Users</a>
        </div>
        <div class="leaf_node">
            <p id="add_user">
                <a href="http://localhost/spanq/user/adduser">New User</a>
            </p>
        </div>
    </div>
    <div class="node">
        <div class="leaf" id="group">
            <a href="http://localhost/spanq/group">Groups</a>
        </div>
        <div class="leaf_node">
            <p id="add_group">
                <a href="http://localhost/spanq/group/addgroup">New Group</a>
            </p>
        </div>
    </div>
</div>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>