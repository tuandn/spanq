<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id="menu_left">
    <div class="node">
        <div class="leaf" id="game">
            <a href="http://localhost/spanq/setting/murder">Game Settings</a>
        </div>
        <div class="leaf_node">
            <p id="murder">
                <a href="http://localhost/spanq/setting/murder">Murder Mystery</a>
            </p>
        </div>
    </div>
    <div class="node">
        <div class="leaf" id="setting_checkin">
            <a href="http://localhost/spanq/setting/checkin">Checkin Settings</a>
        </div>
        <div class="leaf_node">
        </div>
    </div>
    <div class="node">
        <div class="leaf" id="setting_challenge">
            <a href="http://localhost/spanq/setting/challenge">Challenge Settings</a>
        </div>
        <div class="leaf_node">
        </div>
    </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>