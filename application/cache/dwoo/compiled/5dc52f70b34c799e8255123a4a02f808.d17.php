<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><ul id="root">
    <li><a href="http://localhost/spanq/area">Areas</a>
        <ul>
            <li>
                <a href="http://localhost/spanq/area/addarea">New Area</a>
            </li>
        </ul>
    </li>
    <li><a href="http://localhost/spanq/landmark">Landmarks</a>
        <ul>
            <li>
                <a href="http://localhost/spanq/landmark/addlandmark">New Landmarks</a>
            </li>
        </ul>
    </li>
    <li><a href="http://localhost/spanq/station">Stations</a>
        <ul>
            <li>
                <a href="http://localhost/spanq/station/addstation">New Station</a>
            </li>
        </ul>
    </li>
    <li><a href="http://localhost/spanq/challenge">Challenges</a>
        <ul>
            <li>
                <a href="http://localhost/spanq/challenge/addchallenge">New Challenge</a>
            </li>
        </ul>
    </li>
</ul><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>