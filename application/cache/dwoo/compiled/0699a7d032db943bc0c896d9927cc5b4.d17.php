<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <ul>
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
    </ul><?php /* end template body */
return $this->buffer . ob_get_clean();
?>