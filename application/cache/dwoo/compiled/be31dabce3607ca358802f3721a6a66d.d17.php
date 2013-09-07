<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
<ul id="root">
<? $type = $left_type; ?>
<? if ($type == "1") { ?>
    <li class=""><a href="#">Areas</a></li>
    <li class=""><a href="#">Landmarks</a></li>
    <li class=""><a href="#">Stations</a>
        <ul>
            <li class="">
                <a href="#">New Station</a>
            </li>
        </ul>
    </li>
    <li class=""><a href="#">Challenges</a></li>
    <? echo $type;
} ?>
<? elseif($type == "3"){ ?>
    <li class=""><a href="#">Groups</a></li>
    <li class=""><a href="#">Users</a>
        <ul>
            <li class="">
                <a href="#">New User</a>
            </li>
        </ul>
    </li>
    <? echo $type;
} ?>
</ul><?php /* end template body */
return $this->buffer . ob_get_clean();
?>