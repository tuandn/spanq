<?php
/* template head */
/* end template head */
ob_start(); /* template body */
?>
    <ul id="root">
        <li class=""><a href="#">Areas</a>
            <ul>
                <li class="">
                    <a href="#">New Area</a>
                </li>
            </ul>
        </li>
        <li class=""><a href="#">Landmarks</a>
            <ul>
                <li class="">
                    <a href="#">New Landmarks</a>
                </li>
            </ul>
        </li>
        <li class=""><a href="#">Stations</a>
            <ul>
                <li class="">
                    <a href="#">New Station</a>
                </li>
            </ul>
        </li>
        <li class=""><a href="#">Challenges</a>
            <ul>
                <li class="">
                    <a href="#">New Challenge</a>
                </li>
            </ul>
        </li>
    </ul><?php /* end template body */
return $this->buffer . ob_get_clean();
?>